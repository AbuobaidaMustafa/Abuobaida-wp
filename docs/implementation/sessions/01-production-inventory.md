# Session 01: Production inventory and content intake

**Status:** Pending  
**Phase:** 0  
**Size:** S  
**Branch:** `feature/01-production-inventory`  
**Depends on:** 00

## Objective

Bring the live site's real configuration and the owner's content into the repo, so later sessions build on facts rather than inferences.

## Required context

- PROJECT_CONTEXT.md
- CONTENT_STRATEGY.md §7–8
- DECISIONS.md Q-02, Q-03, Q-04, Q-08, Q-09, Q-12
- docs/implementation/qa/local-env/baseline-acf-fields.php

## Prerequisites

- Owner provides: ACF JSON export, WXR content export (optional), plugin list with versions, PHP and WordPress versions, the filled questionnaire (CONTENT_STRATEGY §8)

## Scope

- Save the real ACF field groups to `docs/content/acf-export/` and diff them against the inferred groups; replace `baseline-acf-fields.php` with the real definitions
- Record hosting facts and the plugin list in DECISIONS (close Q-03 and Q-08); confirm or adjust D-13
- Write `docs/content/projects.md` (owner facts only), `docs/content/profile.md` (bio, experience, education) and `docs/content/permissions.md` (reviews, client names, photos)
- If a WXR export is supplied: import it into the local environment and re-run `qa/measure.js` on real content; note the differences from the S00 baseline
- Flag content gaps against gate G2

## Out of scope

- Theme code
- Rewriting the owner's text beyond fixing typos (drafting happens in S09, S13 and S17)

## Expected file changes

| File | Change |
|---|---|
| `docs/content/*` | add |
| `docs/implementation/qa/local-env/baseline-acf-fields.php` | replace |
| `docs/implementation/DECISIONS.md` | update |

## Acceptance criteria

- [ ] Real ACF field groups are versioned
- [ ] Hosting PHP and WordPress versions and the plugin list are recorded
- [ ] `projects.md` contains only owner-confirmed facts, with a G2 gap list

## Tests and verification

- The ACF JSON parses
- The local environment boots with the real field groups and the homepage renders
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Notes

No personal data (phone, IDs) is written into the repo. If the owner sends it, keep it out of committed files.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/01-production-inventory.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 01 (Production inventory and content intake) as specified on branch feature/01-production-inventory.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
