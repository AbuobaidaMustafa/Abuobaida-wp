# Target Architecture (v2)

Read the sections your session spec lists. Decisions referenced: D-02, D-05, D-08, D-13, D-14, D-16, D-19, D-23, D-24.

## 1. Shape

```mermaid
flowchart LR
  subgraph Plugins
    CORE["abuobaida-core (companion plugin)<br/>project, testimonial post types<br/>project_type, project_stack taxonomies<br/>ACF field groups (acf-json)"]
    ACF[ACF free]
    PLL[Polylang free]
    CF7[Contact Form 7]
  end
  subgraph Theme["abuobaida theme (classic + theme.json v3)"]
    TJ[theme.json tokens]
    INC["inc/: setup, assets, content (field helpers), i18n adapter, template tags"]
    TPL["templates: front-page, single-project, archive-project, page, single, index, 404 …"]
    PARTS[template-parts/: site, home, project, components]
    CSS[assets/css: base, layout, components, per-template]
    JS[assets/js: navigation, map-consent, project-filter (optional)]
  end
  CORE --> INC
  ACF --> INC
  PLL --> INC
  CF7 --> PARTS
  TJ --> CSS
  INC --> TPL --> PARTS
```

The theme must render without the companion plugin, ACF, Polylang or CF7. Each missing dependency hides its section and never causes a fatal error.

## 2. Requirements (D-13)

- **Theme header:** `Requires at least: 6.6`, `Tested up to: 7.1`, `Requires PHP: 8.1`.
- **Production target:** WordPress 7.1.x on PHP 8.3 or newer (8.4 recommended). This is needed by Contact Form 7 6.2+.
- **PHPCompatibility** checks `8.1-`.

## 3. Directory structure (target)

```
abuobaida/                      theme (this repository root)
├── style.css                   header only + minimal reset import order note
├── theme.json                  v3: palette, fontFamilies (+fontFace), fontSizes (fluid), spacing, layout widths, element styles
├── functions.php               requires inc/*.php only
├── inc/
│   ├── setup.php               theme supports, menus, image sizes, textdomain, content width
│   ├── assets.php              enqueue: global + per-template CSS/JS, defer strategy, preload LCP font, versions
│   ├── content.php             abuobaida_field(), front-page data, project/testimonial queries (no N+1)
│   ├── i18n.php                adapter over Polylang: current lang, languages list, translated URLs, string registration
│   ├── template-tags.php       markup helpers (posted_on, project meta, tags list, language switcher)
│   ├── template-functions.php  body classes, no-js→js swap, pingback
│   └── customizer.php          global settings: email, social URLs (D-19)
├── front-page.php              homepage (replaces page-home.php; works for every language's front page)
├── single-project.php · archive-project.php · taxonomy-project_type.php
├── page.php · single.php · index.php · archive.php · search.php · 404.php · comments.php
├── header.php · footer.php     ONE shell for all templates
├── template-parts/
│   ├── site/                   header, footer, nav, language-switcher, skip-link
│   ├── home/                   hero, selected-work, capabilities, testimonials, contact
│   ├── project/                card, meta, gallery, next-prev
│   └── components/             section-header, tag-list, button, quote
├── assets/
│   ├── css/                    base.css, layout.css, components.css, templates/{home,project,article,404}.css
│   ├── js/                     navigation.js, map-consent.js, project-filter.js (optional)
│   ├── fonts/                  WOFF2 variable (Latin+Arabic), OFL licence file
│   └── icons/                  inline SVG sprite (stroke icons), license notes
├── languages/                  abuobaida.pot, ar.po/.mo, zh_CN.po/.mo
├── docs/                       planning, baseline, design, QA
└── tools/                      local-env + QA scripts (moved from docs/implementation/qa in S04)

abuobaida-core/                 companion plugin (separate folder/repo, D-05)
├── abuobaida-core.php          register post types/taxonomies, Polylang registration, activation flush
├── acf-json/                   versioned field groups (load/save path)
└── readme.txt
```

## 4. Template map (current → v2)

| Current | v2 | Notes |
|---|---|---|
| `page-home.php` (slug-bound) | `front-page.php` | Required for translated front pages (spike [M]). Keep `page-home.php` as a one-line `require front-page.php` until launch, then delete it. |
| `header.php`, `header-home.php`, `template-parts/header-home.php` | `header.php` + `template-parts/site/*` | One document shell. Valid `<html>`, `<head>` and `<body>`; skip link; `wp_body_open()`. |
| `footer.php`, `footer-home.php` | `footer.php` | — |
| `home.php` (dead fragment) | deleted | `index.php` lists posts. |
| `index.php`, `single.php`, `archive.php`, `search.php`, `comments.php`, `sidebar.php` | kept and restyled | Sidebar only if widgets are active (D-07). |
| — | `page.php` | Block content (About and similar pages). |
| `404.php` + `assets/css/404.css` | restyled | The terminal concept rebuilt locally: no remote GIF and no `@import`. |
| — | `single-project.php`, `archive-project.php`, `taxonomy-project_type.php` | Case study and project listings. |
| `blocks/block-testimonial.php` (empty) | deleted | — |
| `inc/jetpack.php` | kept only if Jetpack is in use (Q-03) | — |

## 5. Data model

### 5.1 Post types and taxonomies (companion plugin)

| Object | Registration | Polylang |
|---|---|---|
| `project` | Public; archive `/projects/`; `show_in_rest`; supports title, editor, excerpt, thumbnail, page-attributes (menu order). | Translatable |
| `project_type` (taxonomy on `project`) | Flat, public, `show_in_rest`. Also the **capabilities** list (D-24); term meta `order`. | Translatable |
| `project_stack` (taxonomy on `project`) | Flat, tag-like (e.g. WordPress, Laravel, PHP, Python). | Not translated: technology names stay the same in every language. |
| `testimonial` | Not public (no single URL), `show_in_rest`. | **Not** translatable: shared across languages (D-09). |

### 5.2 Field groups (free ACF types only, D-16)

**`project_details`** on `project`:

| Field | Type | Notes |
|---|---|---|
| `summary` | Textarea | One or two sentences, shown on cards. |
| `role` | Text | — |
| `year` | Text | e.g. 2026, or 2024–2025 |
| `status` | Select | in progress / delivered / maintained |
| `client_type` | Select | personal / client / research / open source |
| `links` | Group | `live_url` (URL), `repo_url` (URL), `platform_url` (URL) |
| `problem`, `approach`, `outcome` | WYSIWYG | Case-study sections. All optional. |
| `metrics_note` | Textarea | Only real, sourced numbers. |
| `featured` | True/False | Shown on the homepage. |
| `video` | oEmbed | — |

Screenshots go in core Gallery or Image blocks in the post content.

**`front_page`** on the front page of each language (D-19):

| Field | Type |
|---|---|
| `hero_statement` | Textarea |
| `availability` | Group: `show` (True/False), `text` (Text) |
| `contact_intro` | Textarea |
| `contact_form` | Post Object → `wpcf7_contact_form` (one form per language) |
| `resume_file` | File (PDF per language) |
| `map` | Group: `mode` (none / link / click-to-load), `url` (URL) |

**`testimonial_details`** on `testimonial`:

| Field | Type |
|---|---|
| `client_name` | Text |
| `quote_original` | Textarea |
| `quote_lang` | Select: ar / en / zh |
| `quote_en`, `quote_zh`, `quote_ar` | Textarea (translations) |
| `project` | Post Object → `project` |
| `platform_name`, `platform_url` | Text / URL |
| `date` | Date picker |

**`term_order`** on `project_type`: `order` (Number).

**Legacy compatibility:** the existing `about` and `contact_us` groups are read as fallbacks by `abuobaida_field()` until their content has been migrated (S10). They are retired after launch.

### 5.3 Global settings (Customizer, not translated)

- `abuobaida_email`
- `abuobaida_social_github`, `abuobaida_social_linkedin`, `abuobaida_social_mostaql` (URLs). Only filled links render.

## 6. Conventions

**PHP**

- Prefix everything `abuobaida_` / `ABUOBAIDA_`, and rename the `_S_VERSION` constant.
- Follow WPCS 3 (see `phpcs.xml.dist` after S04).
- Escape late: `esc_html`, `esc_attr`, `esc_url`, `wp_kses_post`.
- Translate every string with text domain `abuobaida`, and add translator comments for placeholders.
- No direct database queries.
- Query projects with `no_found_rows` when no pagination is needed, and with `update_post_meta_cache` / `update_post_term_cache` left at their defaults.
- Every third-party call is guarded with `function_exists`/`class_exists` inside `inc/content.php` or `inc/i18n.php`. Templates never call `get_field()` or `pll_*()` directly.

**Templates**

- Exactly one `<h1>` per page and logical heading order.
- Landmarks: `header`, `nav` with `aria-label`, `main`, `footer`.
- Mixed-language strings carry `lang`, and `dir` where the direction differs (for example Arabic quotes on English pages). User-entered names and emails sit in `<bdi>` or `dir="ltr"`.

**CSS**

- Logical properties only: `margin-inline-start`, `inset-inline-end`, `text-align: start`. Never `left`/`right` or `margin-left`/`margin-right`.
- Tokens come only from `theme.json` presets (`var(--wp--preset--color--ink)` and so on).
- Fluid type uses `clamp()`. Respect `prefers-reduced-motion`.
- No content hidden by default: `html.no-js` is swapped to `js` by an inline one-liner before CSS that depends on JS.
- Directional icons (arrows) mirror with `:dir(rtl)`.
- Class names are plain component names (`.project-card`, `.site-nav`). No framework utility classes.

**JS**

- Vanilla, enqueued with `strategy => 'defer'` and only on the templates that need it. Progressive enhancement only.
- Navigation is a disclosure button (`aria-expanded`, `aria-controls`). Escape closes it and focus returns to the button.

**Images**

- Registered sizes: `abuobaida-card` (800×500 crop) and `abuobaida-hero` (1600×900 crop).
- Always `wp_get_attachment_image()`, so `srcset`, lazy loading and `fetchpriority` are handled by core.

## 7. Performance budget (homepage, measured at each UI session)

| Measure | Baseline | Budget |
|---|---|---|
| Theme JS, uncompressed | 433 KB (16 files) | ≤ 20 KB (≤ 2 files) |
| Theme CSS, uncompressed | 355 KB (8 files) | ≤ 60 KB (≤ 3 files) |
| Web fonts | 2 files, 179 KB, plus 3 Google families | ≤ 2 WOFF2 files, ≤ 150 KB, self-hosted, primary one preloaded |
| Third-party requests on page load | 8 | 0 (the map loads only on click) |
| Lighthouse mobile performance (owner's machine or CI) | not measured | ≥ 90; LCP < 2.5 s; CLS < 0.1 |

## 8. Security notes

- No custom form handling: CF7 owns submission, validation and nonces.
- The companion plugin's admin fields use ACF's sanitisation. Custom term meta saves check capabilities and sanitise.
- No `$_GET`/`$_POST` reads in the theme. If a filter UI needs query vars, use `get_query_var()` with registered vars and sanitise them.
- The repository must never contain `wp-config.php`, database dumps or `.env` files (`.gitignore`, S04).
