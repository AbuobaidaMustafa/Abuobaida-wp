# Session 01 — Baseline & content inventory

**Status**: Pending · **Phase**: 0 · **Branch**: `feature/01-baseline-and-content-inventory`

## Objective
Capture the current site as a regression baseline and get every piece of content and configuration the redesign depends on into the repo or docs.

## Required context
- PROJECT_CONTEXT.md
- AUDIT.md §2, §6
- DECISIONS.md Q-02, Q-03, Q-04, Q-07

## Prerequisites
- Owner provides: ACF JSON export, plugin list + versions, PHP/WP versions, WXR export or staging access, project list (Q-02)

## Scope
- Screenshots of home (each section), a post, a page, 404, at 375 / 768 / 1280 / 1920 px (via browser tool if available, else owner screenshots) → `docs/baseline/`
- Save ACF field groups to `acf-json/` (no code change yet beyond the folder)
- Write `docs/baseline/CONTENT_INVENTORY.md`: every text, link, image, file, form and plugin the site uses, and where it comes from
- Record environment facts in `DECISIONS.md` (Q-03) and set D-13
- Collect project details into `docs/content/projects.md` (only owner-supplied facts)

## Out of scope
- Any template, CSS or JS change

## Expected file changes
| File | Change |
|---|---|
| `docs/baseline/*` | add |
| `acf-json/*.json` | add |
| `docs/content/projects.md` | add |
| `DECISIONS.md` | update |

## Acceptance criteria
- [ ] Baseline screenshots exist for every template that renders today
- [ ] ACF groups `about` and `contact_us` are versioned
- [ ] Content inventory lists every hard-coded URL from AUDIT P-07
- [ ] Projects file contains only owner-confirmed facts

## Tests & verification
- Validate ACF JSON parses (`php -r 'json_decode(...)'`)
- Cross-check inventory against `grep` of hard-coded strings
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/01-baseline-and-content-inventory.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 01 (Baseline & content inventory) as specified, on branch
feature/01-baseline-and-content-inventory. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
