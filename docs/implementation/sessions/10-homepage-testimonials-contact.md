# Session 10: Homepage II: testimonials, contact, résumé, map

**Status:** Pending  
**Phase:** 4  
**Size:** M  
**Branch:** `feature/10-home-2`  
**Depends on:** 07, 08

## Objective

Implement the testimonials and contact sections with per-language forms and résumés, migrate the legacy contact data, and finish the homepage.

## Required context

- PROJECT_CONTEXT.md
- Design canvas homepage artboards
- ARCHITECTURE.md §5.2–5.3
- MULTILINGUAL.md §5, §7
- DECISIONS.md D-09, D-19, D-20, Q-11, Q-12, Q-13

## Prerequisites

- S07, S08
- Q-11 permission (or names hidden until confirmed)

## Scope

- `template-parts/home/testimonials.php`: original quote (`lang`/`dir`), translation for the current language labelled "Translated from …", client, project link, platform link; static list, no carousel
- `template-parts/home/contact.php`: intro, email (from the Customizer, `dir=ltr` in Arabic), the CF7 form chosen by the `contact_form` field of the current language's front page, résumé link, social links
- `assets/js/map-consent.js` (only if D-20 = click-to-load): button → iframe with `title`; otherwise a text link
- Run the S07 migration helper locally: legacy `contact_us` and `about` values copied into the front-page fields
- Spam protection per Q-13 (configuration notes for production)

## Out of scope

- Translating the form copy (S17)

## Expected file changes

| File | Change |
|---|---|
| `template-parts/home/{testimonials,contact}.php` | add |
| `assets/js/map-consent.js` | add (optional) |
| `assets/css/templates/home.css` | modify |

## Acceptance criteria

- [ ] With CF7 off, the contact section shows the email only, with no shortcode text
- [ ] Form submission works locally (CF7 mail log or a mail catcher)
- [ ] No third-party request on page load
- [ ] F-06, F-07, F-09, F-10 delivered

## Tests and verification

- Definition of done: `TEST_STRATEGY.md` §4
- Submit the form in each language
- Network panel: 0 third-party requests before interaction
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/10-homepage-testimonials-contact.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 10 (Homepage II: testimonials, contact, résumé, map) as specified on branch feature/10-home-2.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
