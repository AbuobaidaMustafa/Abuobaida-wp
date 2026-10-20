# Session 04: Repo hygiene, dev tooling and CI

**Status:** Done (2026-10-20), on `feature/04-repo-hygiene`  
**Phase:** 2  
**Size:** M  
**Branch:** `feature/04-repo-hygiene (from master)`  
**Depends on:** 00

## Objective

Make the repository identify as this project and give every later session working lint, local-environment and CI commands. No change to front-end output.

## Required context

- PROJECT_CONTEXT.md
- AUDIT.md §2.5, P-14, P-15
- TEST_STRATEGY.md
- docs/implementation/qa/README.md
- DECISIONS.md D-13, D-14, D-17

## Prerequisites

- S00

## Scope

- `.gitignore` (vendor, node_modules, .env, *.sql,*.log, local WordPress folders, .DS_Store) and `.distignore` (docs, tools, tests, configs)
- Move `docs/implementation/qa/` to `tools/` (local-env, measure, nojs) and update the doc references
- `composer.json`: own name and description; dev dependencies: squizlabs/php_codesniffer ^3.13, wp-coding-standards/wpcs ^3.4, phpcompatibility/phpcompatibility-wp, php-parallel-lint; scripts `lint`, `lint:php`, `lint:wpcs`, `make-pot`
- `phpcs.xml.dist`: text domain and prefix `abuobaida`, `minimum_wp_version` 6.6, `testVersion` 8.1-, exclude `assets/vendor`; drop the obsolete WPThemeReview
- `package.json`: remove the `_s` scripts and node-sass; keep only what's used (or remove the file) per D-14
- `tools/qa/check-logical-css.sh`: fails on physical properties (`margin-left`, `left:`, `text-align: left`, …) in theme CSS, excluding vendor files
- `.github/workflows/ci.yml`: php -l on 8.1/8.3/8.5, PHPCS, logical-CSS check (written, not pushed)
- `style.css` header and `readme.txt` metadata (Theme URI, Author, Description, Requires/Tested, licence line); rename `_S_VERSION` to `ABUOBAIDA_VERSION`
- Delete dead files after a verified grep: `home.php`, `blocks/block-testimonial.php`, `template-parts/header-home.php`

## Out of scope

- README rewrite (S19)
- Visual or markup changes
- Removing vendor libraries (S14)
- Mass `phpcbf` formatting of v1 files (it creates noisy diffs; v2 replaces them)

## Expected file changes

| File | Change |
|---|---|
| `.gitignore, .distignore` | add |
| `composer.json, phpcs.xml.dist, package.json` | modify |
| `tools/**` | add (moved) |
| `.github/workflows/ci.yml` | add |
| `style.css (header), readme.txt, functions.php (constant)` | modify |
| `home.php, blocks/block-testimonial.php, template-parts/header-home.php` | remove |

## Acceptance criteria

- [ ] `composer lint` runs (or the GitHub-clone fallback), and the baseline error count is recorded
- [ ] `tools/local-env/setup.sh` still works from scratch
- [ ] The homepage HTML is byte-identical to the S00 baseline, except for the `ABUOBAIDA_VERSION` query strings

## Tests and verification

- Fresh `setup.sh`
- `diff` of rendered homepage HTML before and after
- CI YAML validated with `python -c 'import yaml'`
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided. Also: TEST_STRATEGY §3 paths.

## Notes

Removing `home.php` means a Posts page (if one is ever assigned) uses `index.php`. That is a fix.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/04-repo-hygiene-and-tooling.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 04 (Repo hygiene, dev tooling and CI) as specified on branch feature/04-repo-hygiene.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```

## Outcome (2026-10-20)

**Delivered as specified, with these deviations:**

- **No `composer.lock`:** Packagist is unreachable from Claude's workspace. CI resolves within the constraints. Commit a lock from the owner's machine if reproducible installs matter.
- **PHPCS gate:** the gate is **changed lines**, enforced by `tools/qa/phpcs-changed.py`, not changed files. The legacy v1 files would otherwise block every session.
- **Removed `.eslintrc` and `.stylelintrc.json`:** they were `_s` configs for a toolchain that no longer exists. `tools/qa/check-logical-css.sh` covers the RTL rule.
- **Added:**
  - `tools/qa/get-checkers.sh`, which installs the checkers from GitHub;
  - `tools/build-zip.sh`, which builds the theme zip;
  - `.editorconfig`;
  - `setup.sh` now blocks external HTTP and WP-Cron, and starts with an empty `debug.log`.

**Verified:**

- Rendered HTML of home, post, page, category archive, search, 404 and feed is **byte-identical** before and after.
- `debug.log` stays empty while rendering.
- PHPCS on changed lines: 0 errors. The negative test (an injected `$_GET` echo, and an untracked file) is caught.
- Full PHPCS: **520 errors and 204 warnings in 9 files** (was 650 and 274 in 12).
- `php -l` is clean. `composer validate` passes. The CI YAML parses.
- `setup.sh` works from scratch at its new path.
- The zip excludes docs and tools, installs via WP-CLI and renders.

**Not verified:** the GitHub Actions run itself. It runs when the branch is pushed.
