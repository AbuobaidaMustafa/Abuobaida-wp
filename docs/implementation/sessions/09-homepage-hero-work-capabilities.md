# Session 09: Homepage I: hero, selected work, capabilities

**Status:** Pending  
**Phase:** 4  
**Size:** M  
**Branch:** `feature/09-home-1`  
**Depends on:** 07, 08

## Objective

Implement the approved hero, the selected-work section and the capabilities list from real data, in all three languages.

## Required context

- PROJECT_CONTEXT.md
- Design canvas homepage artboards
- CONTENT_STRATEGY.md §4
- ARCHITECTURE.md §5.2
- DECISIONS.md D-06, D-15, D-23, D-24, Q-09, Q-10

## Prerequisites

- S07, S08
- Featured projects exist (real or `[Placeholder]` fixtures)

## Scope

- `template-parts/home/hero.php`: the name in three scripts (`lang`/`dir` per span), `hero_statement`, availability, CTAs; the contour motif as an inline SVG (`aria-hidden`), if direction A
- `template-parts/home/selected-work.php`: featured projects (one large, the rest in a grid), via `inc/content.php` with one query and no N+1
- `template-parts/components/project-card.php`, used here and in S11
- `template-parts/home/capabilities.php`: `project_type` terms ordered by `term_order`, each linking to its archive when it has projects
- Empty states: no featured projects means the section is hidden, plus an admin-only notice

## Out of scope

- Testimonials, contact (S10)
- Project archive (S11)

## Expected file changes

| File | Change |
|---|---|
| `front-page.php` | modify |
| `template-parts/home/{hero,selected-work,capabilities}.php` | add |
| `template-parts/components/project-card.php` | add |
| `assets/css/templates/home.css` | add |

## Acceptance criteria

- [ ] One `<h1>` (the name)
- [ ] Home in en, ar and zh matches the approved artboards (differences listed)
- [ ] Images use `wp_get_attachment_image` with sizes; the LCP image is not lazy
- [ ] F-01–F-04 delivered or retired per decision

## Tests and verification

- Definition of done: `TEST_STRATEGY.md` §4
- Query count before and after (Query Monitor locally if available, or `SAVEQUERIES`)
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/09-homepage-hero-work-capabilities.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 09 (Homepage I: hero, selected work, capabilities) as specified on branch feature/09-home-1.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
