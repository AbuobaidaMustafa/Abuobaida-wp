# Technical Audit — Abuobaida WordPress Theme

Audit date: 2026-10-14 · Commit audited: `d93a92f` (branch `master`) · Method: full read of every PHP template, `functions.php`, `inc/`, JS and CSS; `php -l` on all PHP files (PHP 8.3); git history; owner-supplied screenshots of the live site.

Legend: **[F]** confirmed fact (read in code or seen in screenshots) · **[A]** assumption, needs confirmation · **[R]** recommendation.

Not verified: the live site could not be fetched (abuobaida.sd blocks automated fetching via robots.txt), and no local WordPress install was run. Live behaviour below comes from the code plus the owner's screenshots.

---

## 1. Current architecture

| Aspect | Finding |
|---|---|
| Theme type | **[F]** Classic PHP theme. Scaffolded from **Underscores (`_s`)**, with the front-end of **iPortfolio v3.3.0 by BootstrapMade** (free edition) pasted into custom templates. |
| Size of custom code | **[F]** Custom work is concentrated in `page-home.php` (~330 lines), `header-home.php`, `footer-home.php`, `404.php`, `assets/css/404.css`. Everything else is `_s` or iPortfolio boilerplate. |
| Entry point for the live homepage | **[F]** `page-home.php` — applied by slug (`page-{slug}.php`) to a page with slug `home`, set as the static front page **[A]**. No `front-page.php`, no `page.php`. |
| Data source | **[F]** ACF: `get_field('about')` and `get_field('contact_us')` (group fields). Testimonials: `cb/carousel` blocks parsed out of the page's post content. Contact form: Contact Form 7 shortcode `id="138"`. Everything else (hero, skills, portfolio, social links, photos, resume URL) is hard-coded. |
| CSS | **[F]** `style.css` (`_s` base, 978 lines) + `assets/css/style.css` (iPortfolio, 1,075 lines) + Bootstrap 5 full + 2 icon fonts + AOS + GLightbox. `style-rtl.css` is an rtlcss copy of the `_s` base only. No tokens/custom properties. |
| JS | **[F]** 11 scripts on every page: Bootstrap bundle, AOS, GLightbox, Isotope, Swiper, Typed.js, Waypoints, PureCounter, php-email-form `validate.js`, `_s` `navigation.js`, iPortfolio `main.js`. PureCounter and `validate.js` are unused. |
| Build tooling | **[F]** `package.json`/`composer.json` are untouched `_s` files: scripts target a `sass/` folder that does not exist, `node-sass` is deprecated, WPThemeReview 0.2 is obsolete. No tests, no CI. |
| Requirements declared | **[F]** "Tested up to 5.4, Requires PHP 5.6" — stale. **[F]** All PHP files lint cleanly on PHP 8.3. |
| Custom post types / taxonomies / DB queries / forms / AJAX / REST | **[F]** None. Portfolio filter shows hard-coded "App / Card / Web". No `$wpdb`, no `$_POST`/`$_GET` handling, no nonces needed today. |
| Git history | **[F]** Two commits on 2023-07-26 (an import + README edit). The four years of work are not represented in history. First commit author is "unknown". |

## 2. Existing functionality to preserve

See the inventory table in `IMPLEMENTATION_PLAN.md` §2 — summary:

- One-page home: hero (name + rotating roles), About (ACF), Skills, Portfolio grid with filter + lightbox, Testimonials (real Mostaql reviews in Arabic, via `cb/carousel`), Contact (ACF info + Google Maps iframe + CF7 form #138).
- Sidebar navigation with anchor scrolling and active-section highlight; mobile toggle; profile photo; social links; **Download Resume** (PDF in uploads).
- Back-to-top button.
- Custom "terminal" 404 page (a distinctive personal touch worth keeping in spirit).
- `_s` features: title-tag, feeds, thumbnails, custom logo, custom background, custom header, Customizer partials, `sidebar-1`, two menu locations (`menu-1`, `sidemenu` — registered but unused), Jetpack infinite-scroll compat, translation-ready text domain `abuobaida` with `.pot`.
- Blog templates (index/single/archive/search/comments) exist but are broken (see P-03). **[A]** Unknown whether you have posts that rely on them.

## 3. Strengths worth retaining

- Underscores base: standard template hierarchy, prefixed functions, text domain set, translation-ready, PHPCS config present.
- Editable content through ACF for About and Contact — the right instinct; extend it rather than replace it.
- Real social proof: genuine client reviews from Mostaql.
- A working contact form via a maintained plugin (CF7) rather than a homemade mailer.
- Personality: the terminal 404 and the conversational About copy.
- PHP 8.3-clean syntax.

## 4. Problems, ranked by severity × impact

| # | Severity | Problem | Evidence |
|---|---|---|---|
| P-01 | **Critical (blocks public release)** | **Licensing.** The front-end is BootstrapMade iPortfolio *free* edition. Its licence requires keeping the "Designed by BootstrapMade" credit (it was removed — see the comments left in `footer-home.php`) and forbids redistributing templates as CMS themes. Demo images (`assets/img/portfolio/*`, `testimonials/*`, `hero-bg.jpg`, `profile-img.jpg`) are template stock; `screenshot.png` appears to be a third-party icon. | `footer-home.php`, `header-home.php` comments, `main.js` header |
| P-02 | **High** | **Invalid document on the homepage and 404.** `header-home.php` prints `<!DOCTYPE><html><head><title>`, then calls `get_header()`, which prints a *second* doctype/html/head with `wp_head()` and closes `</head>`; then `header-home.php` prints `</head><body>`. Result: two doctypes, two `<html>`, two titles, `<body>` without `body_class()`/`wp_body_open()`. | `header-home.php` L1–27, `header.php` |
| P-03 | **High** | **All generic templates are broken.** In `header.php`, `<body>`, `#page`, skip link and site header are inside a PHP comment. Posts, pages, archives and search therefore render with no `<body>` tag and no navigation; `footer.php` closes a `#page` that never opened. | `header.php` L23–60, `footer.php` |
| P-04 | **High** | **The portfolio has no real projects.** Nine hard-coded items share one placeholder image; "More details" links to `portfolio-details.html` (does not exist); filters are template placeholders. Confirmed by screenshot. This is the main job of the site. | `page-home.php` L136–235 |
| P-05 | **High** | **Fatal error if ACF is deactivated** (`get_field()` undefined) and PHP 8 warnings if a group field is empty (array offset on `null`). | `page-home.php` L14, L275 |
| P-06 | **Medium-High** | **Privacy.** Phone number, age, nationality and personal Gmail are published on the page. Owner decision whether to keep. | screenshot, ACF `about.info` |
| P-07 | **Medium** | **Hard-coded environment URLs**: `http://abuobaida.sd/wp-content/uploads/...` for photos, resume and portfolio images (mixed content on HTTPS, breaks locally and on domain change); CF7 form ID 138 hard-coded; favicons use relative `assets/img/...` paths that 404 on every URL. | `header-home.php`, `page-home.php` |
| P-08 | **Medium** | **Performance**: ~11 scripts + ~7 stylesheets on every page including 404; three Google Font families × up to 12 weights, render-blocking; 404 page loads a remote Giphy GIF twice and a font via `@import`; vendor styles enqueued without versions; `assets/vendor` is 11 MB committed with source maps. | `functions.php`, `404.css` |
| P-09 | **Medium** | **Accessibility**: mobile menu toggle is an `<i>` (not focusable, no name); social links are `href="#"` icon-only with no accessible names; all images `alt=""`; two `<h1>`s on the homepage; skills shown as percentage bars (meaningless to readers and to screen readers); typed-text and AOS animations ignore `prefers-reduced-motion`; duplicate `id="main"`; one unclosed `<div>` in the testimonials section. | `header-home.php`, `page-home.php` |
| P-10 | **Medium** | **Content quality**: "PhEmailone" typo; "Nationality" label bound to the `graduation` sub-field; About text says "1+ years" (outdated); social links are dead; sidebar consumes 300 px on every laptop viewport. | screenshot, `page-home.php` L36–45 |
| P-11 | **Low-Medium** | **Escaping**: `esc_attr()` used for element text (should be `esc_html()`); iframe `src` escaped with `esc_attr()` instead of `esc_url()`. Low exploitability (admin-entered data) but wrong. | `page-home.php` |
| P-12 | **Low** | **Latent bugs**: `main.js` src has a stray `"` (`main.js"`) that only works because `esc_url()` strips it; `home.php` is a stray fragment (no header/footer, demo markup) that would render if a Posts page is ever assigned; `<?php//` tags; empty `blocks/block-testimonial.php`; unused `template-parts/header-home.php` (demo "Alex Smith"). | various |
| P-13 | **Low** | **Repository hygiene**: README is unmodified `_s` boilerplate (claims WooCommerce support that doesn't exist); `readme.txt`, `package.json`, `composer.json` still identify as Automattic/_s; constant `_S_VERSION`; no `.gitignore`/`.distignore`. | root files |

## 5. Opportunities

- **Projects as real content**: a `project` post type with structured case-study fields (problem, role, stack, outcome, links, gallery) turns the weakest section into the strongest.
- **Design tokens in `theme.json`** give one source for colours/type/spacing used by both front-end CSS and the block editor.
- **Drop the framework**: the layout needs are modest; modern CSS (grid, custom properties, logical properties, `clamp()`) replaces Bootstrap and lets you delete ~11 MB of vendor code.
- **Multilingual (Arabic / English / Chinese)**: a real differentiator for your background — and RTL done properly with CSS logical properties is itself a showcase of skill.
- **Showcase the code**: a clean, linted, documented public repo is portfolio evidence on its own.

## 6. Technical risks and constraints

- **[A]** Hosting PHP/WP versions unknown → minimum requirements can't be set until confirmed.
- **[A]** ACF field groups are not in the repo (no `acf-json/`); their exact structure is inferred from code. Must be exported before refactoring.
- **[A]** `cb/carousel` is assumed to be the "Carousel Block" plugin; its markup/JS interaction with the theme's Swiper init is unverified.
- Content migration: page-slug-based homepage, CF7 form #138, and uploads URLs must keep working through the transition.
- Multilingual: content translation requires a plugin (see D-08); ACF options and CF7 forms need per-language handling.
- No local environment or tests exist yet → every early change is unverified until a local WP is set up (Session 02).

## 7. Recommended modernization strategy

**Keep the theme, replace the presentation layer.** [R]

A full rewrite is *not* justified on code-quality grounds alone — the PHP surface is small. But the iPortfolio markup, CSS and JS must be replaced anyway because of P-01 (it cannot be published publicly as-is) and because it is what produces P-02, P-04, P-08 and P-09. So:

- **Retain**: the `_s` scaffold and template hierarchy, theme slug/text domain `abuobaida`, ACF content model (extended, versioned in `acf-json/`), CF7 integration, the testimonials content, the 404 concept, and every feature in the inventory.
- **Fix first, on the current design** (small, shippable): document structure, ACF guards, escaping, hard-coded URLs — so the live site is correct before the redesign lands.
- **Replace progressively**: shell (header/nav/footer) → homepage sections → projects → generic templates, removing each vendor library when its last consumer is gone.
- **Architecture**: classic theme + `theme.json` (block-enabled classic). Not a block/Site Editor theme — reasons in `DECISIONS.md` D-02.
