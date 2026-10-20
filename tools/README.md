# Development tools

Everything needed to run, check and package the theme locally. None of it ships in the theme zip (`.distignore`).

| Path | Purpose |
|---|---|
| `local-env/setup.sh` | Local WordPress (7.1.3 by default) + SQLite + ACF + Contact Form 7, plus optional Polylang and the theme unit test data. Everything is fetched from GitHub, so it also works where Packagist and npm are blocked. The theme is symlinked from this repository. |
| `local-env/router.php` | Router for `php -S`, so pretty permalinks work. |
| `local-env/seed.php` | Recreates the v1 homepage content from the owner's screenshots (personal details replaced with placeholders) and CF7 form #138. |
| `local-env/baseline-acf-fields.php` | The v1 ACF field groups `about` and `contact_us`, inferred from `page-home.php` (mu-plugin). Only the v1 baseline needs ACF; v2 doesn't (D-27). |
| `qa/measure.js` | Screenshots at several widths, request and byte counts, axe violations, structure facts, tab order and the reduced-motion check. Writes `report.json` and PNGs. |
| `qa/nojs.js` | Renders a page with JavaScript disabled and reports what stays hidden. |
| `qa/phpcs-changed.py` | PHPCS errors on lines changed since `origin/master`: a short report of the branch's own edits. (The whole theme has passed PHPCS since 1.0.1, so the full run is the CI gate.) |
| `qa/check-logical-css.sh` | **Gate:** fails on physical `left`/`right` CSS (RTL safety). v1 stylesheets are listed in `qa/logical-css-legacy.txt` until v2 replaces them. |
| `qa/get-checkers.sh` | Installs PHPCS + WPCS + PHPCompatibility from GitHub where Composer can't reach Packagist. |
| `build-zip.sh` | Builds `dist/abuobaida-<version>.zip` from a git ref, leaving out `.distignore` entries. |

## Everyday commands

```bash
# Local WordPress
tools/local-env/setup.sh ~/wp-abuobaida [--polylang] [--test-data]
php -S 127.0.0.1:8080 -t ~/wp-abuobaida/wp tools/local-env/router.php
# admin / admin at http://localhost:8080/wp-admin; PHP notices go to ~/wp-abuobaida/debug.log

# Checks (what CI runs)
composer install            # once; needs Packagist
composer lint               # syntax + PHPCS (whole theme) + logical CSS
composer lint:changed       # PHPCS errors on lines changed since origin/master

# Rendered checks
npm install && npx playwright install chromium     # once
npm run qa:measure -- out/ home=http://localhost:8080/ ar=http://localhost:8080/ar/
npm run qa:nojs -- http://localhost:8080/ out/home-nojs.png

# Installable zip of the committed tree
tools/build-zip.sh            # → dist/abuobaida-1.0.0.zip
```

## Without Composer or npm (Claude's cloud workspace)

```bash
eval "$(tools/qa/get-checkers.sh)"      # sets PHPCS="php …/phpcs"
python3 tools/qa/phpcs-changed.py        # changed-lines gate
$PHPCS --report=summary                  # full report
```

- **Playwright:** the scripts fall back to the copy preinstalled in the workspace (`/opt/npm-tools/node_modules/playwright`).
- **axe-core:** set `AXE_PATH` to an `axe.min.js`. Without npm, an older 3.5.3 bundle ships in Deque's Java repository:

```bash
git clone -q --depth 1 --filter=blob:none --no-checkout https://github.com/dequelabs/axe-core-maven-html.git /tmp/axe
git -C /tmp/axe checkout HEAD -- selenium/src/test/resources/files/axe.min.js
export AXE_PATH=/tmp/axe/selenium/src/test/resources/files/axe.min.js
```
