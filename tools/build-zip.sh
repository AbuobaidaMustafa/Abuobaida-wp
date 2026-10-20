#!/usr/bin/env bash
# Build an installable theme zip (abuobaida/ folder inside) from the committed
# tree at a git ref, leaving out everything listed in .distignore.
#
# Usage: tools/build-zip.sh [ref] [out-dir]     (defaults: HEAD, ./dist)
# The zip installs via Appearance → Themes → Add New → Upload Theme.
set -euo pipefail
CALLER_DIR="$PWD"
cd "$(git rev-parse --show-toplevel)"
REF="${1:-HEAD}"
if [ -n "${2:-}" ]; then
	case "$2" in /*) OUT="$2" ;; *) OUT="$CALLER_DIR/$2" ;; esac
else
	OUT="$PWD/dist"
fi
VERSION="$(git show "$REF:style.css" | sed -n 's/^Version:[[:space:]]*//p' | head -1)"
STAGE="$(mktemp -d)"
trap 'rm -rf "$STAGE"' EXIT

mkdir -p "$STAGE/abuobaida" "$OUT"
git archive "$REF" | tar -x -C "$STAGE/abuobaida"

# Apply .distignore (one pattern per line; a leading / anchors to the theme root).
while IFS= read -r pattern; do
	case "$pattern" in ''|'#'*) continue ;; esac
	if [[ "$pattern" == /* ]]; then
		rm -rf "$STAGE/abuobaida${pattern}"
	else
		find "$STAGE/abuobaida" -name "$pattern" -exec rm -rf {} +
	fi
done < <(git show "$REF:.distignore" 2>/dev/null || true) # Refs before S04 have no .distignore.

ZIP="$OUT/abuobaida-${VERSION:-dev}.zip"
rm -f "$ZIP"
(cd "$STAGE" && zip -qr "$ZIP" abuobaida)
echo "$ZIP"
