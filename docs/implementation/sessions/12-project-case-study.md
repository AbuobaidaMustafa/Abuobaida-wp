# Session 12: Project case study template

**Status:** Pending  
**Phase:** 5  
**Size:** M  
**Branch:** `feature/12-case-study`  
**Depends on:** 11

## Objective

Present each project as a concise case study (summary, facts, problem, decisions, results, gallery, next project) that degrades gracefully when fields are empty.

## Required context

- PROJECT_CONTEXT.md
- Design canvas case-study artboard
- CONTENT_STRATEGY.md §5
- ARCHITECTURE.md §5.2

## Prerequisites

- S11

## Scope

- `single-project.php` with the facts list (role, year, status, built with, links), the problem, approach and outcome sections, the before/after table pattern, a core Gallery block with accessible lightbox behaviour (core `lightbox` setting, no GLightbox), an oEmbed video, next and previous project links
- Structured data (`CreativeWork`) only if no SEO plugin provides it (Q-03)
- The first real case study: this theme's rebuild, with S00 "before" numbers and "after" numbers left as `[measure at launch]`

## Out of scope

- Writing the other case studies (owner, S17)

## Expected file changes

| File | Change |
|---|---|
| `single-project.php` | add |
| `template-parts/project/{facts,sections,next-prev}.php` | add |
| `assets/css/templates/project.css` | modify |

## Acceptance criteria

- [ ] A project with only a title and summary renders cleanly (no empty headings)
- [ ] External links have clear names; images have `srcset`
- [ ] Matches the artboard in en and ar

## Tests and verification

- Definition of done: `TEST_STRATEGY.md` §4
- Render a full project and a minimal project
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/12-project-case-study.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 12 (Project case study template) as specified on branch feature/12-case-study.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
