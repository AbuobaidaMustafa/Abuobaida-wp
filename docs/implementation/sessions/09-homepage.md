# Session 09 — Homepage sections

**Status**: Pending · **Phase**: 4 · **Branch**: `feature/09-homepage`

## Objective
Rebuild the homepage with the design system and real content, preserving every existing section's function.

## Required context
- PROJECT_CONTEXT.md
- docs/design/DIRECTION.md
- IMPLEMENTATION_PLAN.md F-01..F-07
- DECISIONS.md D-06, D-09, D-15, Q-07

## Prerequisites
- Sessions 06, 08
- Owner-approved About text (Q-07)

## Scope
- `front-page.php` composed of `template-parts/home/*`: hero, about, skills (grouped, no %), selected projects (featured `project` posts), testimonials, contact
- Keep compatibility: page slug `home` still works (front-page.php takes precedence; `page-home.php` retired after verification)
- Testimonials per D-09 (no autoplay; accessible)
- Contact: CF7 per language, map iframe loaded on click (privacy + performance)
- Personal details per D-06
- Remove Typed.js, AOS, Waypoints, PureCounter, Swiper (if unused) from enqueue

## Out of scope
- Project archive/single (10, 11)

## Expected file changes
| File | Change |
|---|---|
| `front-page.php` | add |
| `template-parts/home/*` | add |
| `page-home.php` | remove after parity check |
| `inc/assets.php` | modify |

## Acceptance criteria
- [ ] Every F-01..F-07 behaviour present or retired by decision
- [ ] Single `<h1>`; logical heading order
- [ ] Home in ar/en/zh matches approved mockup
- [ ] No layout shift from fonts/images (CLS < 0.1)

## Tests & verification
- Lighthouse (performance/a11y/SEO) before/after
- Screenshots vs mockup in 3 languages
- CF7 submission on local WP (mail catcher)
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/09-homepage.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 09 (Homepage sections) as specified, on branch
feature/09-homepage. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
