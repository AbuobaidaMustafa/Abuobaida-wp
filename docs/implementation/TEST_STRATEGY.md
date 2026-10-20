# Test and Verification Strategy

**Principle:** nothing is called "working" unless it was run. Every session's handoff lists what was verified, how, and what could not be verified.

## 1. Environments

| Environment | What it's good for | How |
|---|---|---|
| **Claude's cloud workspace** (proven in S00) | PHP lint, PHPCS, a local WordPress, Playwright screenshots, axe, no-JS and RTL renders, the Polylang spike | `tools/local-env/setup.sh <dir> [--polylang] [--test-data]` (WordPress 7.1.3 + SQLite + ACF + CF7, all from GitHub). Packagist and npm are blocked there, so PHPCS and its standards are cloned from GitHub (§3). |
| **Owner's machine** | Lighthouse, real browsers (Safari, Firefox, Chrome), screen readers, real fonts and images | `wp-env` (Docker) or LocalWP, or the same `setup.sh` (needs git, PHP and Composer). |
| **CI (GitHub Actions)**, added in S04 and run only once the owner pushes | Lint matrix on every push | PHP 8.1, 8.3 and 8.5 `php -l`; PHPCS (WPCS + PHPCompatibilityWP); logical-CSS check. |
| **Staging** (S18, if the host allows it) | Migration rehearsal, Polylang setup, final QA on real data | Host's staging, or a theme preview on production (Appearance → Themes → Live Preview) as a fallback. |

## 2. Baselines (S00, kept for comparison)

- Measurements: `docs/baseline/report.json`. Screenshots: `docs/baseline/screens/`. Summary: AUDIT §2.
- Visual reference for the live site: the owner's screenshots, because external fonts and images are blocked locally.
- The **after** column of the case-study table is filled from the same scripts at launch.

## 3. Commands

```bash
# Local WordPress (see script header for options)
tools/local-env/setup.sh ~/wp-abuobaida --test-data
php -S 127.0.0.1:8080 -t ~/wp-abuobaida/wp tools/local-env/router.php

# PHP syntax
find . -name '*.php' -not -path './vendor/*' -print0 | xargs -0 -n1 php -l | grep -v 'No syntax errors'

# Coding standards. Composer works on the owner's machine (S04 adds composer scripts).
# Where Packagist is blocked, clone PHP_CodeSniffer 3.13, WPCS 3.4, PHPCSUtils,
# PHPCSExtra, PHPCompatibility 9.3.5, PHPCompatibilityWP and PHPCompatibilityParagonie
# from GitHub and set installed_paths: exact commands in tools/README.md.
phpcs --standard=phpcs.xml.dist

# Rendered checks: screenshots at 4 widths, request and byte counts, axe, tab order
AXE_PATH=node_modules/axe-core/axe.min.js node tools/qa/measure.js out/ \
  home=http://localhost:8080/ home_ar=http://localhost:8080/ar/ home_zh=http://localhost:8080/zh/ \
  project=http://localhost:8080/projects/<slug>/ notfound=http://localhost:8080/nope/

# Content visible with JavaScript off
node tools/qa/nojs.js http://localhost:8080/ out/home-nojs.png

# Theme strings
wp i18n make-pot . languages/abuobaida.pot && msgfmt --statistics languages/ar.po
```

## 4. Definition of done (every implementation session)

1. **Lint:** `php -l` is clean. PHPCS shows **0 errors in changed files**; warnings are justified in the handoff.
2. **Runtime:** with `WP_DEBUG` on, rendering the touched templates in **en, ar and zh** adds no new lines to `debug.log`.
3. **Degradation:** touched templates render without a fatal error when **ACF**, **Polylang**, **CF7** or **abuobaida-core** is deactivated, one at a time.
4. **Screenshots** of the touched templates at **375 and 1280 px in en, ar and zh** are compared with the approved design (G1). Differences are listed.
5. **Accessibility:**
   - axe shows **no serious or critical** violations on the touched templates;
   - keyboard pass: every interactive element is reachable, focus is visible, the menu opens and closes, there are no traps;
   - one `<h1>`.
6. **No-JS:** all content is visible and navigable with JavaScript off.
7. **RTL:** no physical CSS properties in new or changed CSS (logical-CSS check). The Arabic screenshot mirrors correctly.
8. **Performance:** the homepage stays within the budget in ARCHITECTURE §7, with numbers recorded.
9. **Docs:** HANDOFF, SESSION_INDEX and the plan's progress log are updated, and DECISIONS too if anything was decided.

## 5. Compatibility matrix

| Dimension | Automated | Manual |
|---|---|---|
| PHP | Lint on 8.1, 8.3, 8.5 (CI). PHPCompatibility `8.1-`. Runtime on 8.3 (workspace). | Production PHP (Q-03) |
| WordPress | 7.1.x (workspace). 6.6 smoke test before release (S16). | — |
| Plugins | ACF free 6.8, CF7 6.2, Polylang 3.8. Each one off, one at a time. | Production plugin set (Q-03) |
| Browsers | Chromium | Safari (macOS/iOS), Firefox, Chrome on Android (owner) |
| Assistive tech | axe, tab order | VoiceOver or NVDA on home, a case study and the menu, in en and ar (owner, S15) |
| Viewports | 360, 375, 768, 1024, 1280, 1440, 1920 | Owner's phone |
| Zoom and text | 200% and 400% zoom, text spacing (S15) | — |

## 6. Known tool limits

- In Claude's workspace, axe-core is **3.5.3** (bundled in a GitHub repository). Use axe 4.x wherever npm is reachable.
- Lighthouse and the Nu HTML validator are unavailable in the workspace. Run them on the owner's machine or in CI. Until then, a structural HTML check (doctype, `html`, `head`, `body`, `title` and `h1` counts, duplicate IDs) is done with the measurement script.
- The type rules for the Design canvas say not to screenshot its artboards. Design-to-build checks compare the **built pages** with the artboards by eye, from screenshots of the built pages.
