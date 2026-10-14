# QA tooling (reference copies)

These are the exact scripts used for the S00 baseline. Session 04 moves them to `tools/` and adds composer and npm scripts. Until then, run them from here.

| File | Purpose |
|---|---|
| `local-env/setup.sh` | Local WordPress 7.1.3 + SQLite + ACF + CF7 (+ Polylang, + theme unit test data) from GitHub only. Tested from scratch in S00. |
| `local-env/router.php` | Router for `php -S` so pretty permalinks work. |
| `local-env/seed.php` | Recreates the current homepage content from the owner's screenshots, with placeholders for personal details. Also creates CF7 form #138. |
| `local-env/baseline-acf-fields.php` | The ACF field groups `about` and `contact_us`, **inferred from `page-home.php`**. Replace them with the real export (Q-04). |
| `measure.js` | Screenshots, request and byte counts, axe violations, structure facts, tab order and the reduced-motion check. Output is `report.json` plus PNGs. |
| `nojs.js` | Renders a page with JavaScript disabled and reports the opacity of animated elements. |

## Getting the checkers where Packagist and npm are blocked

```bash
# PHPCS + WordPress Coding Standards + PHPCompatibility, from GitHub
mkdir -p ~/phpcs && cd ~/phpcs
for spec in "PHPCSStandards/PHP_CodeSniffer 3.13.6" "WordPress/WordPress-Coding-Standards 3.4.1" \
            "PHPCSStandards/PHPCSUtils 1.2.3" "PHPCSStandards/PHPCSExtra 1.5.1" \
            "PHPCompatibility/PHPCompatibility 9.3.5" "PHPCompatibility/PHPCompatibilityWP 2.1.8" \
            "PHPCompatibility/PHPCompatibilityParagonie 1.3.4"; do
  set -- $spec; git clone -q --depth 1 --branch "$2" "https://github.com/$1.git" "$(basename "$1")"
done
P=$PWD; php PHP_CodeSniffer/bin/phpcs --config-set installed_paths \
  $P/WordPress-Coding-Standards,$P/PHPCSUtils,$P/PHPCSExtra,$P/PHPCompatibility,$P/PHPCompatibilityWP,$P/PHPCompatibilityParagonie

# axe-core: prefer `npm i axe-core` (4.x). Without npm, an older 3.5.3 bundle ships
# in Deque's Java repository:
git clone -q --depth 1 --filter=blob:none --no-checkout https://github.com/dequelabs/axe-core-maven-html.git /tmp/axe
git -C /tmp/axe checkout HEAD -- selenium/src/test/resources/files/axe.min.js
export AXE_PATH=/tmp/axe/selenium/src/test/resources/files/axe.min.js
```

Playwright: the scripts use a local `playwright` install if present. Otherwise they use the copy preinstalled in Claude's cloud workspace (`/opt/npm-tools/node_modules/playwright`).
