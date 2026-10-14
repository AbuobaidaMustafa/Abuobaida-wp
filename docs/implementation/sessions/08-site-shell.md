# Session 08: Site shell: header, navigation, language switcher, footer

**Status:** Pending  
**Phase:** 3  
**Size:** M  
**Branch:** `feature/08-site-shell`  
**Depends on:** 06

## Objective

Build the approved header, navigation (desktop and the phone disclosure), language switcher and footer, correct in LTR and RTL, keyboard-complete, with Polylang configured locally per MULTILINGUAL §2.

## Required context

- PROJECT_CONTEXT.md
- DESIGN_SYSTEM.md
- Design canvas: header, navigation and switcher artboards
- MULTILINGUAL.md §2–5, §8
- ARCHITECTURE.md §6 (JS)
- DECISIONS.md D-08, D-12, D-19

## Prerequisites

- S06
- G1
- Q-07 (default language) answered or the D-12 default used

## Scope

- Register menu locations (`primary`, `footer`); one menu per language in the local environment
- `template-parts/site/header.php`: site name in the current language, primary navigation, résumé link (front-page field of the current language), language switcher (native names, `lang`, `hreflang`, `aria-current`)
- `assets/js/navigation.js`: disclosure button with `aria-expanded`; Escape closes it and focus returns to the button; no-JS fallback (menu visible or reachable)
- Footer: copyright, social links from the Customizer (only filled ones; accessible names; inline SVG icons), source-code link, back-to-top anchor
- Customizer settings: email and social URLs (D-19)
- Verify and record: `x-default` alternate, core sitemap behaviour with Polylang, switcher fallback for untranslated pages

## Out of scope

- Homepage sections
- Project templates

## Expected file changes

| File | Change |
|---|---|
| `template-parts/site/*.php` | add |
| `assets/js/navigation.js` | rewrite |
| `assets/css/components.css` | modify |
| `inc/customizer.php, inc/i18n.php, inc/template-tags.php` | modify |

## Acceptance criteria

- [ ] Keyboard only: everything reachable, visible focus, the menu operable, no trap
- [ ] At 320 px: no horizontal scroll in en, ar or zh
- [ ] Arabic: the shell mirrors correctly, and directional icons flip while others don't
- [ ] Matches the approved artboards (differences listed)
- [ ] F-08, F-09, F-11 preserved

## Tests and verification

- Definition of done: `TEST_STRATEGY.md` §4
- Polylang off: the shell renders without a switcher
- Screenshots of the shell in 3 languages at 375 and 1280
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided. Also: MULTILINGUAL §3 (record the newly verified behaviour).

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/08-site-shell.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 08 (Site shell: header, navigation, language switcher, footer) as specified on branch feature/08-site-shell.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
