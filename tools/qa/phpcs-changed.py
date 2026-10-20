#!/usr/bin/env python3
"""Report PHPCS errors only on lines changed since a base ref.

The v1 theme carries hundreds of legacy violations (AUDIT §2.5) that the v2
rebuild replaces wholesale, so a full PHPCS run can't be a gate yet. This
script makes the rule "no new violations" enforceable today: it runs PHPCS
(with phpcs.xml.dist) on changed PHP files and fails only on errors that sit
on added or modified lines, including uncommitted and untracked files.

Usage:
    python3 tools/qa/phpcs-changed.py [BASE_REF]      # default: origin/master, else master

PHPCS binary: $PHPCS (may include an interpreter, e.g. "php ~/phpcs/bin/phpcs"),
else vendor/bin/phpcs, else phpcs on PATH. See tools/README.md.
"""
import json
import os
import re
import shlex
import shutil
import subprocess
import sys

ROOT = subprocess.run(["git", "rev-parse", "--show-toplevel"], capture_output=True, text=True, check=True).stdout.strip()
os.chdir(ROOT)


def git(*args):
    return subprocess.run(["git", *args], capture_output=True, text=True, check=True).stdout


def resolve_base(arg):
    candidates = [arg] if arg else ["origin/master", "master"]
    for ref in candidates:
        if subprocess.run(["git", "rev-parse", "-q", "--verify", ref], capture_output=True).returncode == 0:
            return git("merge-base", ref, "HEAD").strip()
    sys.exit(f"Base ref not found: {', '.join(candidates)}")


def phpcs_command():
    if os.environ.get("PHPCS"):
        return shlex.split(os.environ["PHPCS"])
    if os.access("vendor/bin/phpcs", os.X_OK):
        return ["vendor/bin/phpcs"]
    found = shutil.which("phpcs")
    if found:
        return [found]
    sys.exit("phpcs not found: run `composer install`, or set PHPCS (tools/qa/get-checkers.sh prints the value).")


def changed_lines(base):
    """Map file -> set of changed line numbers (None = whole file)."""
    result = {}
    diff = git("diff", "-U0", "--no-color", "--diff-filter=ACMR", base, "--", "*.php")
    current = None
    for line in diff.splitlines():
        if line.startswith("+++ "):
            path = line[4:]
            current = path[2:] if path.startswith("b/") else None
            if current:
                result.setdefault(current, set())
        elif line.startswith("@@") and current:
            match = re.match(r"@@ -\d+(?:,\d+)? \+(\d+)(?:,(\d+))? @@", line)
            start, count = int(match.group(1)), int(match.group(2) or 1)
            result[current].update(range(start, start + count))
    for path in git("ls-files", "--others", "--exclude-standard", "--", "*.php").splitlines():
        result[path] = None
    return {path: lines for path, lines in result.items() if os.path.isfile(path) and (lines is None or lines)}


def main():
    base = resolve_base(sys.argv[1] if len(sys.argv) > 1 else None)
    files = changed_lines(base)
    if not files:
        print("No changed PHP files.")
        return 0
    proc = subprocess.run(phpcs_command() + ["--report=json", "-q", *sorted(files)], capture_output=True, text=True)
    try:
        report = json.loads(proc.stdout)
    except json.JSONDecodeError:
        print(proc.stdout or proc.stderr)
        sys.exit("PHPCS did not return a JSON report.")

    errors = warnings = 0
    for path, data in sorted(report.get("files", {}).items()):
        rel = os.path.relpath(path, ROOT)
        lines = files.get(rel, set())
        for msg in data.get("messages", []):
            if lines is not None and msg["line"] not in lines:
                continue
            kind = msg["type"]
            errors += kind == "ERROR"
            warnings += kind == "WARNING"
            print(f"{rel}:{msg['line']}:{msg['column']}: {kind.lower()}: {msg['message']} [{msg['source']}]")
    checked = sorted(os.path.relpath(p, ROOT) for p in report.get("files", {}))
    skipped = sorted(set(files) - set(checked))
    print(f"\nChecked changed lines in: {', '.join(checked) or 'none'}")
    if skipped:
        print(f"Excluded by phpcs.xml.dist: {', '.join(skipped)}")
    print(f"{errors} error(s), {warnings} warning(s) on changed lines (base {base[:8]}).")
    return 1 if errors else 0


if __name__ == "__main__":
    sys.exit(main())
