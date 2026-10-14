# Session 07: Companion plugin and content model

**Status:** Pending  
**Phase:** 2  
**Size:** M  
**Branch:** `feature/07-content-model (plugin repo or /plugins/abuobaida-core)`  
**Depends on:** 01, 04

## Objective

Create `abuobaida-core` with the `project` and `testimonial` post types, the `project_type` and `project_stack` taxonomies, versioned ACF field groups and Polylang registration, plus local fixtures.

## Required context

- PROJECT_CONTEXT.md
- ARCHITECTURE.md §5, §8
- MULTILINGUAL.md §2
- DECISIONS.md D-05, D-08, D-09, D-16, D-19, D-24, Q-08
- docs/content/projects.md (if S01 is done)

## Prerequisites

- S04
- Q-08 answered (ACF free or PRO); default free
- D-05 confirmed: plugin location (separate repo or `plugins/` folder in this repo)

## Scope

- Register the post types and taxonomies exactly as in ARCHITECTURE §5.1; flush rewrite rules on activation and deactivation only
- ACF JSON load and save paths inside the plugin; field groups `project_details`, `front_page`, `testimonial_details`, `term_order` (free field types)
- Polylang: add `project` and `project_type` via `pll_get_post_types` and `pll_get_taxonomies`; keep `testimonial` and `project_stack` untranslated
- Admin columns: featured, year, type; menu order support
- Fixtures (local only): a WP-CLI `eval-file` seeding the S00 real items (this theme's rebuild, the two Mostaql projects, the two reviews) plus placeholders clearly titled `[Placeholder]`
- Migration helper (WP-CLI command, dry-run by default) copying `about` and `contact_us` values into `front_page` fields

## Out of scope

- Front-end templates
- Production data entry (S17, S18)

## Expected file changes

| File | Change |
|---|---|
| `abuobaida-core/abuobaida-core.php` | add |
| `abuobaida-core/acf-json/*.json` | add |
| `abuobaida-core/readme.txt` | add |
| `tools/local-env/fixtures.php` | add |

## Acceptance criteria

- [ ] Projects and testimonials are editable with every field; a project can be translated in Polylang
- [ ] Everything works with ACF off (meta stored and read via the helper, no fatal error)
- [ ] PHPCS clean for the plugin
- [ ] Migration dry-run lists the values it would copy

## Tests and verification

- Definition of done: `TEST_STRATEGY.md` §4
- Create, translate and delete a project locally
- Plugin activate/deactivate cycle
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided. Also: ARCHITECTURE §5 if fields change.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/07-content-model-plugin.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 07 (Companion plugin and content model) as specified on branch feature/07-content-model.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
