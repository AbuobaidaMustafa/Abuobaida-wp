# Session 14: Performance, vendor removal, asset and licence clean-up

**Status:** Pending  
**Phase:** 7  
**Size:** M  
**Branch:** `feature/14-cleanup`  
**Depends on:** 09–13

## Objective

Remove everything v1 left behind (vendor libraries, iPortfolio CSS and JS, demo images), meet the performance budget, and make every bundled asset properly licensed.

## Required context

- PROJECT_CONTEXT.md
- ARCHITECTURE.md §7
- AUDIT.md P-01, P-10, P-14
- DECISIONS.md D-26

## Prerequisites

- S09–S13

## Scope

- Delete `assets/vendor/*`, `assets/css/style.css` (iPortfolio), `assets/js/main.js`, `header-home.php`, `footer-home.php`, `page-home.php` (after the front-page parity check), the old `js/` folder if unused, and unreferenced demo images — each after a grep shows no references
- Replace `screenshot.png` (1200×900) with a real screenshot of v2
- `CREDITS.md` and the `readme.txt` credits: `_s` (GPL), fonts (OFL), icons (licence)
- Measure the budget table (ARCHITECTURE §7) and record it in HANDOFF and in the case study draft

## Out of scope

- Server or CDN tuning

## Expected file changes

| File | Change |
|---|---|
| `assets/vendor/**, assets/css/style.css, assets/js/main.js, header-home.php, footer-home.php, page-home.php, assets/img/**` | remove |
| `screenshot.png` | replace |
| `CREDITS.md` | add |

## Acceptance criteria

- [ ] `grep -ri bootstrapmade` and `grep -ri iportfolio` return nothing in the tree
- [ ] No 404s in the network panel on any template
- [ ] Theme JS ≤ 20 KB, CSS ≤ 60 KB, fonts ≤ 150 KB, 0 third-party requests on load

## Tests and verification

- Definition of done: `TEST_STRATEGY.md` §4
- `tools/qa/measure.js` on all templates; compare with the baseline
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/14-performance-and-cleanup.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 14 (Performance, vendor removal, asset and licence clean-up) as specified on branch feature/14-cleanup.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
