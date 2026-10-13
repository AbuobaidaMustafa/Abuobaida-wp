# Session 08 — Multilingual foundation & RTL

**Status**: Pending · **Phase**: 3 · **Branch**: `feature/08-multilingual-and-rtl`

## Objective
Make the site serve Arabic, English and Chinese with correct direction, language attributes, switcher and SEO signals.

## Required context
- PROJECT_CONTEXT.md
- DECISIONS.md D-03, D-08, D-10, D-12

## Prerequisites
- Session 07
- D-08, D-12 decided

## Scope
- Install/configure Polylang on local WP (languages ar, en, zh_CN; URL prefixes per D-12)
- `inc/i18n.php`: adapter functions (current language, language list, translated URL) that degrade gracefully without Polylang
- Accessible language switcher in header (native language names, `lang`/`hreflang` attributes, current marked with `aria-current`)
- `<html lang dir>` correct per language; `hreflang` alternates (via Polylang)
- Retire `style-rtl.css`/rtlcss: logical CSS covers RTL; verify icons that imply direction are mirrored
- Menus per language; CF7 form per language (field labels translated); ACF fields per translation
- Generate `languages/abuobaida.pot`; create `ar.po` and `zh_CN.po` skeletons

## Out of scope
- Writing the translated copy (15)

## Expected file changes
| File | Change |
|---|---|
| `inc/i18n.php` | add |
| `template-parts/site/language-switcher.php` | add |
| `style-rtl.css` | remove (after verification) |
| `languages/*` | add/update |

## Acceptance criteria
- [ ] Switching language keeps you on the equivalent page
- [ ] Arabic pages render RTL with no mirrored-layout bugs in the shell
- [ ] Theme works (single-language) with Polylang deactivated
- [ ] Validator: correct `lang`/`dir`

## Tests & verification
- Screenshot shell in ar/en/zh at 375 and 1280
- Keyboard test of switcher
- Deactivate Polylang → no fatal
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/08-multilingual-and-rtl.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 08 (Multilingual foundation & RTL) as specified, on branch
feature/08-multilingual-and-rtl. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
