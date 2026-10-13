# Session 05 — Design system & tokens (incl. RTL/CJK)

**Status**: Pending · **Phase**: 1 · **Branch**: `feature/05-design-system`

## Objective
Turn the approved direction into `theme.json` tokens, base CSS and documented components that work in LTR, RTL and CJK.

## Required context
- PROJECT_CONTEXT.md
- docs/design/DIRECTION.md
- DECISIONS.md D-10, D-11, D-14

## Prerequisites
- Session 04

## Scope
- `theme.json` v3: colour palette, font families, fluid type scale (`clamp`), spacing scale, content/wide widths
- Self-hosted fonts (`assets/fonts`, WOFF2, subset, `font-display: swap`) incl. Arabic; CJK system stack
- Per-language typography: `:lang(ar)` line-height/size adjustments, no letter-spacing or uppercase for Arabic; no italics for Chinese
- `assets/css/base.css`, `layout.css`, `components.css` using logical properties only
- Components: button, link, tag/chip, card, form fields (CF7 styling), section header, with hover/focus-visible/active/disabled/error states
- Breakpoints documented; `prefers-reduced-motion` respected
- `docs/DESIGN_SYSTEM.md` + a hidden style-guide page template (`page-templates/style-guide.php`, not linked) for visual QA

## Out of scope
- Rebuilding real templates (07+)

## Expected file changes
| File | Change |
|---|---|
| `theme.json` | add |
| `assets/css/{base,layout,components}.css` | add |
| `assets/fonts/*` | add |
| `inc/assets.php` | modify |
| `docs/DESIGN_SYSTEM.md` | add |

## Acceptance criteria
- [ ] Style-guide page renders all components in en/ar/zh without overlap or clipped glyphs
- [ ] All text/background pairs pass WCAG AA
- [ ] No physical properties (`left/right`, `margin-left`…) in new CSS (`grep`)
- [ ] Editor shows the same palette/fonts

## Tests & verification
- Stylelint (logical-properties rule) on new CSS
- Screenshot style-guide page in each language at 375/1280
- Contrast checker
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/05-design-system.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 05 (Design system & tokens (incl. RTL/CJK)) as specified, on branch
feature/05-design-system. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
