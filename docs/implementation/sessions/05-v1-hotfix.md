# Session 05: Optional hotfix of the live v1 theme

**Status:** Done (2026-10-20), on `feature/05-v1-hotfix` (theme 1.0.1)  
**Phase:** 2  
**Size:** M  
**Branch:** `feature/05-v1-hotfix (from master)`  
**Depends on:** 04

## Objective

Make the live theme produce valid, robust documents with content visible without JavaScript, with no visual change, so the live site is correct while v2 is built (D-22).

## Required context

- PROJECT_CONTEXT.md
- AUDIT.md §2.2–2.5, P-02–P-05, P-11, P-13
- header.php, header-home.php, footer.php, footer-home.php, page-home.php, 404.php, functions.php

## Prerequisites

- S04 merged (lint and local environment)
- The owner decides whether to deploy it

## Scope

- One document shell: `header.php` prints doctype, `<html language_attributes>`, `wp_head()`, `<body body_class>`, `wp_body_open()` and a skip link; `header-home.php` keeps only the sidebar markup
- Generic templates get a valid `<body>` and a minimal navigation (`wp_nav_menu('menu-1')`)
- Enqueue Google Fonts and favicons (Site Icon) instead of printing them; fix the `main.js"` path
- Remove the hard ACF dependency (D-27): read the homepage fields with `get_field()` when ACF is active, otherwise straight from post meta (`about_*`, `contact_us_*`); handle empty fields; escape with `esc_html` and `esc_url`
- Content visible without JS: scope AOS's hidden state to `html.js` (an inline `no-js`→`js` swap) and disable AOS and Typed under `prefers-reduced-motion`
- Accessible names for icon links, a `<button>` for the mobile toggle, `title` on the iframe, one `<main>`, `alt` text
- Make the CF7 form ID and the hard-coded upload URLs filterable or field-driven where trivial

## Out of scope

- Visual redesign
- Vendor removal
- Content rewrite
- Multilingual

## Expected file changes

| File | Change |
|---|---|
| `header.php, header-home.php, footer.php, footer-home.php` | modify |
| `page-home.php, 404.php` | modify |
| `functions.php` | modify |
| `assets/js/main.js` | modify (guards) |

## Acceptance criteria

- [ ] Each template: exactly one doctype/html/head/body/title (structure check)
- [ ] ACF off: no fatal error; empty fields: no warnings
- [ ] JS off: all homepage sections visible
- [ ] axe on home: no `link-name` or `frame-title` violations; the toggle is keyboard-operable
- [ ] Screenshot diff with the baseline shows no intended visual change

## Tests and verification

- `tools/qa/measure.js` and `tools/qa/nojs.js` before and after (table in HANDOFF)
- ACF on/off and empty-field tests as in S00
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Notes

Deploying is the owner's step. Provide a zip and a changelog line.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/05-v1-hotfix.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 05 (Optional hotfix of the live v1 theme) as specified on branch feature/05-v1-hotfix.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```

## Outcome (2026-10-20): theme 1.0.1

**Delivered:** every scope item, plus the following.

- **Full PHPCS is clean.** The remaining legacy formatting issues were fixed and the obsolete `wp_body_open()` shim removed, so the whole theme passes WPCS 3.4 and PHPCompatibility with 0 errors and 0 warnings (was 650 errors and 274 warnings). CI now gates on the full run.
- **Shared layout:** posts, pages, archives and search get the same sidebar, footer and readable link colour as the homepage. Before, they had no `<body>` and no navigation.
- **Customizer:** social profile URLs and the CF7 form ID. Empty URLs keep the old `#` icons, so the sidebar looks the same until real URLs are entered.
- **404 fix:** the page is no longer 300 px too wide.
- **Small content fixes:** the "PhEmailone" label, the "WordPress" spelling in the typed roles, and the hero roles shown as plain text when JavaScript is off or reduced motion is on.

**Verified on WordPress 7.1.3** (local, with images from the live uploads unavailable):

| Check | Before | After |
|---|---|---|
| Doctype / html / title / body per page | 2/2/2/1 on home and 404; no `<body>` on post, page, archive, search | 1/1/1/1 on all six |
| ACF deactivated | HTTP 500 | HTTP 200, HTML identical to ACF on |
| Empty fields | 6 PHP warnings | 0 |
| CF7 deactivated | raw shortcode printed | contact info only |
| JavaScript off | 9 of 9 animated blocks invisible | all visible; skill bars drawn; roles listed |
| Reduced motion | AOS and typing run | no animation; roles as text |
| axe on home | 7 rules (link-name 5, frame-title, duplicate-id, 2 × main …) | heading-order, region (v1 structure; v2) |
| axe on post / page / search | color-contrast 109–119 nodes | none |
| axe on 404 | link-name 5 | none |
| Mobile menu toggle | `<i>`, not focusable, no name | `<button>`, Tab-reachable, "Menu", `aria-expanded` |
| Homepage pixels vs before (375–1920 px) | — | 0.1–0.35 % differ. The difference is entirely the sidebar photo: locally the image can't load, and its new alt text takes up space. No intended visual change. Menu button identical. |
| `debug.log` while rendering | — | empty |
| 1.0.1 zip | — | installs fresh via WP-CLI and renders |

**Not verified:**

- The live site itself, and the real `cb/carousel` markup when JavaScript is off (the testimonial stacking CSS is generic).
- Safari and Firefox.
- A screen-reader pass.

**Known v1 limits left for v2:**

- two `<h1>`s;
- the hero sits outside the `<main>` landmark;
- the off-canvas mobile menu's links stay in the Tab order while it's closed;
- the "More details" portfolio links go to a page that doesn't exist;
- the BootstrapMade credit question (Q-15).
