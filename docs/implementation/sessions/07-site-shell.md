# Session 07 — Site shell: header, navigation, footer

**Status**: Pending · **Phase**: 3 · **Branch**: `feature/07-site-shell`

## Objective
Replace the iPortfolio sidebar with the new accessible header/navigation/footer used by every template.

## Required context
- PROJECT_CONTEXT.md
- docs/DESIGN_SYSTEM.md
- IMPLEMENTATION_PLAN.md F-08..F-11

## Prerequisites
- Sessions 03, 05

## Scope
- `template-parts/site/header.php`: site name/logo, `wp_nav_menu( 'menu-1' )` with fallback, resume link, mobile disclosure button (`aria-expanded`, `aria-controls`, Escape closes, focus management)
- Anchor links work on home and from other pages (`home_url('/#about')`)
- Footer: copyright, social links (only filled ones, accessible names, inline SVG icons), back-to-top anchor
- Social/resume settings via Customizer or ACF options (choose one, record decision)
- Remove Bootstrap/boxicons/bootstrap-icons from the shell; keep them enqueued only for not-yet-migrated home sections

## Out of scope
- Language switcher (08)
- Home sections (09)

## Expected file changes
| File | Change |
|---|---|
| `header.php, footer.php, template-parts/site/*` | modify/add |
| `assets/js/navigation.js` | replace |
| `assets/icons/sprite.svg` | add |
| `inc/assets.php` | modify |

## Acceptance criteria
- [ ] Keyboard-only: all nav reachable, visible focus, menu toggle operable
- [ ] Menu editable in Appearance → Menus
- [ ] Works at 320 px without horizontal scroll
- [ ] F-08–F-11 preserved

## Tests & verification
- Keyboard walkthrough
- axe DevTools / Lighthouse a11y on home and a post
- Screenshots 375/768/1280
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/07-site-shell.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 07 (Site shell: header, navigation, footer) as specified, on branch
feature/07-site-shell. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
