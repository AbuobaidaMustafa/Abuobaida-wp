# Session 11: Projects archive and filter

**Status:** Pending  
**Phase:** 5  
**Size:** M  
**Branch:** `feature/11-projects-archive`  
**Depends on:** 07, 08

## Objective

Provide `/projects/` and the per-type archives with a filter that works without JavaScript.

## Required context

- PROJECT_CONTEXT.md
- Design canvas archive artboards
- ARCHITECTURE.md §4–6
- DECISIONS.md D-15, D-24

## Prerequisites

- S07, S08

## Scope

- `archive-project.php` and `taxonomy-project_type.php` using the project card
- The filter as real links to the type archives, with the current one marked (`aria-current`); optional small JS that only prefetches, no client-side filtering
- Ordering: menu order, then year; pagination when there are more than 12; empty state copy
- Translated labels; RTL check

## Out of scope

- Search-as-you-type
- Isotope-style animation (D-15)

## Expected file changes

| File | Change |
|---|---|
| `archive-project.php, taxonomy-project_type.php` | add |
| `template-parts/project/*.php` | add |
| `assets/css/templates/project.css` | add |

## Acceptance criteria

- [ ] Filtering works with JS off
- [ ] One query per page (plus term cache), no N+1
- [ ] The archive matches its artboards in 3 languages

## Tests and verification

- Definition of done: `TEST_STRATEGY.md` §4
- SAVEQUERIES or Query Monitor
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/11-projects-archive.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 11 (Projects archive and filter) as specified on branch feature/11-projects-archive.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
