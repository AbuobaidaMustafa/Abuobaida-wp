# Session 05: Optional hotfix of the live v1 theme

**Status:** Pending  
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
- Guard ACF (`function_exists`) and empty fields; escape with `esc_html` and `esc_url`
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
