# Session 13 — Vendor removal & performance

**Status**: Pending · **Phase**: 7 · **Branch**: `feature/13-vendor-removal-and-performance`

## Objective
Remove every unused third-party library and reach a lean, measured performance baseline.

## Required context
- PROJECT_CONTEXT.md
- AUDIT.md P-08
- inc/assets.php

## Prerequisites
- Sessions 09–12

## Scope
- Delete `assets/vendor/*` libraries no longer referenced (Bootstrap, icon fonts, AOS, GLightbox, Isotope, Swiper, Typed, Waypoints, PureCounter, validate.js) — verify by grep + rendered pages
- Conditional enqueue per template; `defer`/`strategy` for scripts; versioned assets (filemtime in dev)
- Preload primary font; image sizes and `fetchpriority` for hero/LCP image
- Remove old `assets/css/style.css` iPortfolio CSS and `_s` base rules no longer used

## Out of scope
- Server/hosting tuning

## Expected file changes
| File | Change |
|---|---|
| `assets/vendor/*` | remove |
| `assets/css/style.css` | remove |
| `inc/assets.php` | modify |

## Acceptance criteria
- [ ] No 404s in network panel on any template
- [ ] Lighthouse mobile performance ≥ 90 on home (local, record numbers)
- [ ] Total JS on home < 20 KB (excluding plugins)

## Tests & verification
- Lighthouse before/after table in HANDOFF
- grep for removed handles
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/13-vendor-removal-and-performance.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 13 (Vendor removal & performance) as specified, on branch
feature/13-vendor-removal-and-performance. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
