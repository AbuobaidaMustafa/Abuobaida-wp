# Handoff

*Last updated: 2026-10-14, end of Session 00 (v2 replan).*

## Current state

- **Code:** no theme file changed.
- **Branch:** local `docs/modernization-plan`, two commits on top of `master` (v1 plan, v2 replan). **Not pushed.**
- **Docs added:**
  - planning set: `AUDIT.md` (measured), `IMPLEMENTATION_PLAN.md`, `DECISIONS.md`, `ARCHITECTURE.md`, `MULTILINGUAL.md`, `CONTENT_STRATEGY.md`, `DESIGN_BRIEF.md`, `TEST_STRATEGY.md`;
  - 20 session specs;
  - `docs/baseline/` (screenshots and `report.json`);
  - `qa/` (moved to `tools/` in S04), a reproducible local WordPress recipe and the measurement scripts.
- **Design:** the pre-design canvas *Portfolio Theme Pre-design* is at <https://claude.ai/artifact/DF4jsBp8VwhkEZWAERxXzK> (private to the owner). Three directions (A Survey recommended, B Console, C Two Rivers), 10 artboards, with A shown in English, Arabic and Chinese plus a case study and a token sheet.

## What changed from the first plan (v1 → v2)

1. The audit is now **measured** on WordPress 7.1.3. New findings:
   - content is invisible without JS;
   - HTTP 500 without ACF;
   - translated homepages fall back to `index.php`;
   - accent contrast is 3.0:1;
   - exact page weights.
2. **Platform facts** now shape the plan:
   - Underscores is inactive;
   - CF7 6.2 needs PHP 8.3 and WordPress 7.1;
   - free ACF has no Repeater, Gallery or Options page;
   - Polylang free behaviour was verified (`redirect_lang` is needed for `/ar/`).
3. A **design gate G1** (owner request, D-18) comes before any UI code, and the pre-design canvas is already built.
4. The **content model** is redesigned for free ACF and Polylang free: capabilities are `project_type` terms, testimonials are shared, settings are split between the front page and the Customizer.
5. **Delivery model:** an optional v1 hotfix on `master`; v2 on its own branch, launched in one switch with a rollback.
6. New supporting docs: architecture, multilingual, content, design and test strategy, a risk register and gates G0–G4.

## Waiting on the owner

1. **Review the design canvas.** Pick A, B, C or a mix (D-25). Confirm the Arabic spelling of your name, whether to use 马飞, and the photo question (Q-10).
2. **Accept or amend the 🟡 decisions** (gate G0). The most consequential ones: D-02 (classic + `theme.json`), D-05 (companion plugin), D-06 (hide personal details), D-08 (Polylang free), D-12 (English default), D-17 (branching), D-22 (hotfix yes or no).
3. **Inputs for S01:** hosting PHP and WordPress versions plus the plugin list (Q-03), ACF free or PRO (Q-08), the ACF and content exports (Q-04), and the content questionnaire (CONTENT_STRATEGY §8).

## Next recommended tasks

- **S02, design review.** It starts as soon as you give feedback on the canvas.
- **S04, repo hygiene and tooling.** It needs no input and can run in parallel.

## Verified vs not verified (S00)

**Verified (run):**

- Everything in AUDIT §2 is measured.
- `tools/local-env/setup.sh` works from scratch (WordPress 7.1.3 served, theme active, seeded homepage).
- Polylang free's `lang`/`dir`/`hreflang` output and its front-page URL behaviour.

**Not verified:**

- The live site itself (it blocks automated fetching).
- Lighthouse scores and Nu HTML validation (not available in the sandbox).
- Real fonts and images in local renders (third-party hosts blocked).
- The real ACF field groups (inferred).
- `cb/carousel` = the "Carousel Block" plugin (assumed).
- Hosting PHP version.

**Tool limits:** axe-core 3.5.3 was used (older). Use 4.x where npm is reachable.
