# Session 06: v2 foundation: structure, tokens, fonts, assets, i18n adapter

**Status:** Pending  
**Phase:** 2  
**Size:** L  
**Branch:** `feature/06-v2-foundation (from v2)`  
**Depends on:** 03 (G1), 04

## Objective

Create the v2 branch skeleton every UI session builds on: modular `inc/`, `theme.json` tokens from the approved design, self-hosted fonts, base CSS, the conditional asset loader, the single document shell and the i18n adapter.

## Required context

- PROJECT_CONTEXT.md
- ARCHITECTURE.md §1–4, §6–7
- MULTILINGUAL.md §5–6
- docs/DESIGN_SYSTEM.md
- DECISIONS.md D-02, D-10, D-13, D-14, D-17

## Prerequisites

- G1 passed (S03)
- S04 merged into master; create `v2` from master

## Scope

- `functions.php` requires `inc/{setup,assets,content,i18n,template-tags,template-functions,customizer}.php`
- `theme.json` v3: palette, font families with `fontFace` (self-hosted WOFF2 in `assets/fonts/`, OFL file included), fluid font sizes, spacing scale, content and wide widths, element styles
- `assets/css/base.css` (reset, `:lang()` rules, focus ring, reduced motion), `layout.css` and `components.css` from DESIGN_SYSTEM; logical properties only
- `inc/assets.php`: global CSS; per-template CSS and JS registered and enqueued conditionally; `strategy => defer`; preload of the primary font; filemtime versions in local, `ABUOBAIDA_VERSION` otherwise; **stop enqueuing all `assets/vendor` files on v2 templates**
- `header.php` and `footer.php`: a single valid shell, `no-js` swap, skip link; placeholder header and footer parts (fleshed out in S08)
- `front-page.php` skeleton (sections stubbed) and `page-home.php` as a one-line include of it
- `inc/i18n.php` adapter (current language, language list, translated URL, `is_rtl` passthrough, string registration), working without Polylang
- `inc/content.php`: `abuobaida_field()` wrapper with a default and the legacy fallback (`about`, `contact_us`)
- Regenerate `languages/abuobaida.pot`

## Out of scope

- Final header, navigation and footer UI (S08)
- Homepage sections (S09, S10)
- Plugin and content model (S07)

## Expected file changes

| File | Change |
|---|---|
| `functions.php, inc/*.php` | rewrite/add |
| `theme.json` | add |
| `assets/css/{base,layout,components}.css` | add |
| `assets/fonts/*` | add |
| `header.php, footer.php, front-page.php, page-home.php` | rewrite/add |
| `languages/abuobaida.pot` | regenerate |

## Acceptance criteria

- [ ] Every template renders one valid document
- [ ] Tokens visible in the editor (palette and font sizes) and on the front end as `--wp--preset--*`
- [ ] Theme CSS ≤ 25 KB, JS 0 KB at this stage
- [ ] No PHP notices with any plugin off
- [ ] Logical-CSS check passes

## Tests and verification

- Definition of done: `TEST_STRATEGY.md` §4
- Structure check on home, page, post, 404
- Plugin-off matrix
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided. Also: ARCHITECTURE.md if the structure deviates.

## Notes

Confirm that `theme.json` `fontFace` prints `@font-face` in a classic theme on 7.1 (expected via `wp_print_font_faces`); record the result.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/06-v2-foundation.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 06 (v2 foundation: structure, tokens, fonts, assets, i18n adapter) as specified on branch feature/06-v2-foundation.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
