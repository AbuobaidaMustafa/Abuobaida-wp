# Technical Audit (v2, measured)

**Audit date:** 2026-10-14
**Commit audited:** `d93a92f` (`master`)
**Supersedes:** the v1 audit from the same day, which was based on reading the code only.

How to read the tags:

- **[M] Measured:** reproduced on a running copy of the theme.
- **[F] Fact:** read directly in the code or git history.
- **[O] Owner's screenshots of the live site.**
- **[A] Assumption:** still needs confirming.
- **[R] Recommendation.**

## 0. Method and environment

| Item | Detail |
|---|---|
| Runtime | WordPress **7.1.3** (latest release) on PHP 8.3.6 with the official SQLite drop-in. ACF 6.8.10 (free) and Contact Form 7 6.2.2 were installed. The homepage was rebuilt from the owner's screenshots, using placeholder values for phone, age and email. The WordPress theme unit test data was imported to exercise the generic templates. Recipe: `tools/local-env/setup.sh` (moved from `docs/implementation/qa/` in S04), tested from scratch. |
| Browser checks | Chromium (Playwright 1.56). Screenshots at 375, 768, 1280 and 1920 px. Request and byte counts per page. axe-core 3.5.3, the only bundle reachable in this sandbox; it is older but covers the rules cited here. Tab-order probe, JavaScript-disabled render, reduced-motion render and a forced-RTL render. Scripts: `tools/qa/measure.js`, `tools/qa/nojs.js`. Raw results: `../baseline/report.json`. Screenshots: `../baseline/screens/`. |
| Static checks | `php -l` on every PHP file (clean on 8.3). PHPCS 3.13.6 with WPCS 3.4.1 and PHPCompatibilityWP 2.1.8, `testVersion 8.1-`. |
| Multilingual spike | Polylang 3.8.11 (free), configured for en, ar and zh_CN, with translated front pages and a test `project` post type. |
| Not possible here | The live site (robots.txt blocks automated fetching). Lighthouse and the Nu HTML validator (their package hosts are blocked in this sandbox). Screen readers. External fonts and images on the local copy (third-party hosts blocked), so local screenshots show fallback fonts and missing photos. The owner's screenshots are the visual baseline. |

## 1. Current architecture

| Aspect | Finding |
|---|---|
| Theme type | **[F]** A classic PHP theme. It is the Underscores (`_s`) scaffold with the free BootstrapMade *iPortfolio v3.3.0* front-end pasted into custom templates. |
| Upstream | **[F]** Underscores was declared **inactive** on 2025-09-05: "we won't be actively updating this _s starter theme… This repo will be archived". There is no upstream left to track. |
| Homepage | **[F]** `page-home.php` is selected **by page slug** (`home`), with `get_header('home')` and `get_footer('home')`. |
| Data | **[F]** ACF groups `about` (whoami, title, details, info{graduation, phone, city, age, email, freelancer}) and `contact_us` (loc, email, call, map). Testimonials are `cb/carousel` blocks parsed out of the page content. The contact form is the CF7 shortcode with hard-coded `id="138"`. Everything else (hero, skills, portfolio items, social links, photos, résumé URL, hero background) is hard-coded, partly as `http://abuobaida.sd/wp-content/uploads/...` URLs. **[A]** The field groups are not in the repo; their structure above is inferred from the code. |
| Custom code size | **[F]** The custom work is ~600 lines across `page-home.php`, `header-home.php`, `footer-home.php`, `404.php` and `assets/css/404.css`. The rest is `_s` or iPortfolio boilerplate. |
| Assets | **[F]** `assets/vendor` is 11 MB across 11 libraries, including all Bootstrap builds and source maps. Every library is enqueued on every page. Four web-font families are used: Open Sans, Raleway and Poppins from Google, plus Roboto Mono via CSS `@import`. |
| Tooling | **[F]** `package.json` and `composer.json` are unmodified `_s` files. Their scripts target a missing `sass/` folder with deprecated `node-sass`. `phpcs.xml.dist` still uses the `_s` prefix and text domain. There are no tests, no CI and no `.gitignore`. |
| History | **[F]** Two commits (2023-07-26). The four years of work before that are not in git. |

## 2. Measured baseline

### 2.1 Page weight

All sizes are uncompressed bytes, measured locally. External hosts were blocked and counted separately.

| Page | Requests | Script files / KB | Stylesheets / KB | Fonts | External requests attempted |
|---|---|---|---|---|---|
| Home | 28 | 16 / 433 | 8 / 355 | 2 / 179 KB | 8 (fonts.googleapis.com, abuobaida.sd, <www.google.com>) |
| Post | 25 | 16 / 433 | 8 / 355 | – | 1 |
| Page | 25 | 16 / 433 | 8 / 355 | – | 1 |
| Search | 25 | 16 / 433 | 8 / 355 | – | 1 |
| 404 | 28 | 16 / 433 | 9 / 357 | 2 / 179 KB | 5 (including media.giphy.com, twice) |

### 2.2 Document structure **[M]**

| Page | Doctypes | `<html>` | `<title>` | `<body>` | Notes |
|---|---|---|---|---|---|
| Home | **2** | **2** | **2** | 1, without `body_class()` or `wp_body_open()` | 2 × `<h1>`, 2 × `<main id="main">`, 11/11 images without `alt`, 6 `href="#"` links |
| Post, page, archive, search | 1 | 1 | 1 | **0** | `header.php` comments out `<body>`, `#page`, the skip link and the site header. These pages render as unstyled text with sidebar widgets and no navigation (`screens/post-1280.jpg`). |
| 404 | **2** | 2 | 2 | 1 | Horizontal overflow at 1280 px: the page is 1580 px wide. |

### 2.3 Behaviour **[M]**

| Test | Result |
|---|---|
| ACF deactivated | **HTTP 500**: `Call to undefined function get_field()` at `page-home.php:14`. |
| ACF active, fields empty | Six PHP 8 warnings: "array offset on null" at `page-home.php` lines 22, 30, 288, 294, 300 and 302. |
| JavaScript disabled | **All 9 animated blocks** in the hero, About, Skills, Portfolio, Testimonials and Contact sections stay at `opacity: 0`, so the homepage content is invisible (`screens/home-nojs-1280.jpg`). |
| `prefers-reduced-motion: reduce` | The animations still run. Typed.js keeps typing, and 8 below-the-fold blocks start hidden. |
| Keyboard, 375 px | The mobile menu toggle is an `<i>` with `tabIndex = -1` and no name, so it is **unreachable by keyboard**. The first Tab stops are five unnamed social links (`href="#"`). |
| Forced RTL (`dir="rtl"`) | The fixed sidebar stays on the physical left while its text aligns right, which gives a half-mirrored layout. The iPortfolio CSS uses physical properties throughout, and Bootstrap's RTL build is not enqueued (`screens/home-rtl-forced-1280.jpg`). |
| Polylang, Arabic and Chinese front pages | Translated front pages render with **`index.php`**, with no hero or sections, because `page-home.php` only matches the slug `home`. See §2.6. |

### 2.4 Accessibility (axe-core 3.5.3, desktop 1280 px) **[M]**

| Page | Violations (rule: affected nodes) |
|---|---|
| Home | link-name: 5 (serious), frame-title: 1 (serious), heading-order: 2, landmark-no-duplicate-main: 1, landmark-unique: 1, region: 1, duplicate-id: 1 |
| Post / page / search | color-contrast: 113–119 (serious). The accent `#149ddd` on white is **3.04:1**, and on `#f5f8fd` it is 2.86:1. AA needs 4.5:1. |
| 404 | link-name: 5 (serious) |
| Archive | Mostly caused by the test content's comment forms (duplicate IDs). The theme's own share is color-contrast. |

### 2.5 Coding standards (WPCS 3.4.1, PHPCompatibilityWP, PHP 8.1+) **[M]**

- **650 errors and 274 warnings in 12 files.** 871 of the 924 are whitespace and formatting issues that `phpcbf` can fix automatically.
- **Substantive findings:**
  - two unescaped outputs (`render_block()` in `page-home.php:257` and `$cat` in `home.php:26`);
  - stylesheets printed directly in the header instead of enqueued (2);
  - 7 enqueues without a version;
  - unprefixed globals: 7 variables, 1 constant (`_S_VERSION`) and 1 function;
  - 3 `<?php//` tags, which PHP outputs as literal text (dead `home.php` only);
  - 1 overridden WordPress global;
  - 8 blocks of commented-out code.
- **Escaping misuse not caught by WPCS:**
  - `esc_attr()` is used for element text in about 20 places (should be `esc_html()`);
  - the map iframe `src` uses `esc_attr()` (should be `esc_url()`).
- **PHP 8.1–8.5 compatibility:** no issues reported. Syntax lints clean on 8.3.

### 2.6 Platform facts that constrain the plan

| Fact | Source | Consequence |
|---|---|---|
| WordPress 7.1 (released 2026-08-19) requires PHP 7.4+ and recommends 8.4/8.5. | WordPress Hosting handbook | Target the current release, and declare a modern minimum PHP. |
| `theme.json` schema v3 is the latest in 7.1. Script `strategy`/`fetchpriority`, script modules and `wp_print_font_faces()` all exist. | `wp-includes` of 7.1.3 | A classic theme plus `theme.json` v3 is fully supported. Use `defer` scripts and theme.json font faces. |
| **Contact Form 7 6.2.2 requires WordPress 7.1 and PHP 8.3.** | CF7 `readme.txt` | **[A]** If the host runs PHP below 8.3, CF7 can't update. Hosting must be checked (Q-03). |
| **Free ACF ships no Repeater, Gallery, Flexible Content, Clone or Options page.** It does include Group, Image, File, oEmbed, Link, Taxonomy, Relationship and Post Object, and it registers an `acf/field` block-bindings source. | ACF 6.8.10 `includes/fields/` and `src/Blocks/Bindings.php` | The content model must work with free field types unless the owner has ACF PRO (Q-08). |
| Polylang free sets `<html dir="rtl" lang="ar">` and prints `hreflang` alternates for en, ar and zh. The front page is served at `/ar/` and `/zh/` only when "the front page URL contains the language code" (`redirect_lang`) is on. Without it, `/ar/` returns a 301 to `/ar/home-ar/`. | Spike **[M]** | Configuration steps are recorded in `MULTILINGUAL.md`. |
| Polylang documents Site Editor (block-theme) translation of patterns and template parts as a **Polylang Pro** feature, and says templates themselves cannot be translated. Its ACF integration is also Pro. | polylang.pro docs | This favours a classic theme. Translated content lives in posts and fields per language. |
| BootstrapMade's free licence requires the "Designed by BootstrapMade" credit (removed in `footer-home.php`) and forbids redistributing templates as CMS themes. | bootstrapmade.com/license | The iPortfolio layer **cannot be published** in a public theme repository. |

## 3. Existing functionality to preserve

The feature inventory, F-01 to F-15, is in `IMPLEMENTATION_PLAN.md` §3. Every feature there must be preserved or retired by a recorded decision.

## 4. Strengths worth retaining

- The template hierarchy, prefixed functions and translation-ready text domain `abuobaida` from Underscores.
- Structured content in ACF for About and Contact, which is the right instinct to build on.
- Genuine client reviews from Mostaql (Arabic). This is real social proof.
- A maintained form plugin (CF7) instead of a hand-rolled mailer. No custom input handling exists, so there is no nonce or sanitising debt.
- Personality: the terminal-style 404 and the conversational About text.
- PHP 8.x-clean syntax.

## 5. Problems ranked by severity and impact

| # | Severity | Problem | Evidence |
|---|---|---|---|
| P-01 | Critical (blocks public release) | Licence: the free iPortfolio template with its credit removed. Demo images, a third-party icon used as `screenshot.png`, and the template's CSS and JS. | §2.6, `footer-home.php` |
| P-02 | High | Two documents in one on the homepage and the 404 page. | §2.2 [M] |
| P-03 | High | Posts, pages, archives and search render with no `<body>` and no navigation. | §2.2 [M] |
| P-04 | High | Homepage content is invisible without JavaScript, and animations ignore reduced motion. | §2.3 [M] |
| P-05 | High | Fatal error when ACF is inactive. PHP warnings when fields are empty. | §2.3 [M] |
| P-06 | High | No real projects: nine placeholder tiles, "details" links to a page that doesn't exist, template filters. | code, [O] |
| P-07 | High (new requirement) | Not multilingual. A slug-bound homepage and physical CSS block Arabic and Chinese. | §2.3 [M] |
| P-08 | Medium-High | Keyboard and screen reader: an unreachable menu toggle, unnamed icon links, missing `alt`, duplicate `main`, an untitled iframe, and an accent colour that fails AA. | §2.4 [M] |
| P-09 | Medium-High | Privacy: phone, age, nationality and a personal Gmail address are published. | [O] |
| P-10 | Medium | Weight: 433 KB JS and 355 KB CSS on every page. Render-blocking third-party fonts, including a CSS `@import`. A remote GIF on the 404. 11 MB of vendor code in the repository. | §2.1 [M] |
| P-11 | Medium | Environment-bound URLs: `http://abuobaida.sd/...` for photos, résumé and hero image (mixed content, broken locally). The CF7 ID is hard-coded. Favicons use relative paths that 404. | code |
| P-12 | Medium | Content accuracy: the "PhEmailone" typo, a Nationality label bound to the `graduation` field, "1+ years" experience, and dead social links. | [O], code |
| P-13 | Low-Medium | Escaping and standards: `esc_attr()` used for text, 2 unescaped outputs, 7 unversioned enqueues. | §2.5 [M] |
| P-14 | Low | Dead code: the `home.php` fragment, an empty `blocks/block-testimonial.php`, unused `template-parts/header-home.php`, a stray `"` in the `main.js` path, commented-out blocks, and 10 unreferenced demo images. | code |
| P-15 | Low | Repository hygiene: README and `readme.txt` are `_s` boilerplate (claiming WooCommerce support). The metadata identifies the project as Automattic/_s. No ignore files. | root |

## 6. Opportunities

- **Projects as structured, translatable content** (a `project` post type with case-study fields) turns the weakest section into the strongest.
- **A trilingual site done properly** is itself a portfolio piece: logical CSS, correct `lang`/`dir`/`hreflang`, and typography tuned for each script.
- **Drop the framework.** The layout needs are modest. About 11 MB of vendor code goes away, and the measured before/after becomes case-study material.
- **Tie skills to evidence.** Capabilities link to the projects that prove them, instead of percentage bars.
- **The repository as a showcase:** linted, documented, reproducible local setup (already prototyped), and CI.

## 7. Recommended strategy

Rebuild the presentation layer and keep the theme. This is not a full rewrite.

- **Keep:** the theme slug and text domain, the template hierarchy, the ACF content model (extended and versioned), CF7, the testimonials, the 404 concept, the `_s` features that are used, and every item in the feature inventory.
- **Replace:**
  - all iPortfolio markup, CSS and JS;
  - the slug-bound homepage, which becomes `front-page.php`;
  - the split `header-home`/`footer-home` shells, which become one shell;
  - all vendor libraries.
- **Add:**
  - a `project` content model in a small companion plugin;
  - Polylang-based multilingual support;
  - `theme.json` tokens;
  - QA tooling.
- **Why not a full rewrite:** the PHP surface is small and sound where it isn't template residue. Rewriting the hooks, supports and content model would add risk without benefit.
- **Why replacing the presentation is justified:** P-01 (licence) alone requires it. P-02, P-04, P-07, P-08 and P-10 all come from that same layer.
- **Architecture:** a classic theme plus `theme.json` v3. The full trade-off is in `DECISIONS.md` D-02.
- **Delivery:**
  - Optional hotfix on `master` for P-02, P-03, P-04 and P-05, so the live site is correct now.
  - The redesign is built on a `v2` branch behind a design approval gate and launched in one switch, with a rollback path (`IMPLEMENTATION_PLAN.md` §8).
