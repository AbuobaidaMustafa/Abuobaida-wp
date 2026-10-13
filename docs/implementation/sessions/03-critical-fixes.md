# Session 03 — Critical fixes on the current theme

**Status**: Pending · **Phase**: 2 · **Branch**: `feature/03-critical-fixes`

## Objective
Make the live theme produce valid documents and fail safely, without changing its look, so the site is correct before the redesign lands.

## Required context
- PROJECT_CONTEXT.md
- AUDIT.md P-02, P-03, P-05, P-07, P-11, P-12

## Prerequisites
- Sessions 01, 02

## Scope
- One document shell: `header.php` outputs doctype, `<html language_attributes>`, `wp_head()`, `<body body_class>`, `wp_body_open()`, skip link; `header-home.php` no longer prints its own doctype/head/title
- Restore working markup for generic templates (`#page` opened/closed consistently)
- Move Google Fonts + favicons to enqueue / Site Icon (remove relative favicon paths)
- `inc/acf.php`: `abuobaida_field( $name, $default )` helper; guard all `get_field()` uses; no PHP warnings on empty fields
- Escaping: `esc_html()` for text, `esc_url()` for iframe/links
- Replace hard-coded `http://abuobaida.sd/...` URLs with fields or attachment IDs (documented in inventory); CF7 form ID from a field/constant
- Fix `main.js"` path, duplicate `id="main"`, unclosed div, 'PhEmailone' typo, Nationality↔graduation label mismatch (confirm field)

## Out of scope
- Visual redesign
- Removing vendor libraries
- Content rewrite

## Expected file changes
| File | Change |
|---|---|
| `header.php, header-home.php, footer.php, footer-home.php` | modify |
| `page-home.php, 404.php` | modify |
| `functions.php → inc/assets.php, inc/acf.php` | modify/add |

## Acceptance criteria
- [ ] Home, page, post, archive, search, 404 each output exactly one doctype/html/head/body (W3C validator: no structural errors)
- [ ] Deactivating ACF shows the page without fatal error
- [ ] PHP 8.x: no warnings with empty ACF fields (WP_DEBUG on)
- [ ] Visual diff vs baseline: no intentional changes
- [ ] No hard-coded domain in theme files (`grep abuobaida.sd`)

## Tests & verification
- Validator on rendered HTML
- WP_DEBUG log clean
- Screenshot compare with `docs/baseline/`
- `composer lint` on changed files
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Notes
This can be deployed to the live site on its own (owner decides).

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/03-critical-fixes.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 03 (Critical fixes on the current theme) as specified, on branch
feature/03-critical-fixes. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
