# Project Context (read first in every session)

**Project**: Modernize the personal WordPress portfolio theme of Abuobaida Mustafa (web developer: PHP, WordPress, Laravel, full-stack; growing AI/ML focus).
**Repo**: https://github.com/AbuobaidaMustafa/Abuobaida-wp · theme slug / text domain `abuobaida` · live site abuobaida.sd
**Separate from**: the owner's Dropshipping OMS project — never mix code, docs or repos.

## Current state (short)
- Classic theme: Underscores (`_s`) scaffold + BootstrapMade iPortfolio front-end (free licence — must be replaced before public release).
- Homepage = `page-home.php` (page slug `home`). Data: ACF groups `about`, `contact_us`; testimonials = `cb/carousel` blocks in page content; contact = CF7 form #138.
- No CPTs, no tests, no build that works. Full findings: `AUDIT.md`.

## Target
- Classic theme + `theme.json`, no CSS framework, vanilla JS, logical CSS properties.
- Languages: **Arabic (RTL), English, Chinese (zh_CN)** — Polylang for content, `.po/.mo` for theme strings.
- `project` CPT with case-study fields; real projects only.
- Design: "engineering notebook" — editorial, typography-led, light-first.

## Rules for every session
1. Read only: this file, `SESSION_INDEX.md`, the active session file, relevant `DECISIONS.md` entries, relevant code. Do not redo the audit.
2. Inspect code before changing it; preserve features in `IMPLEMENTATION_PLAN.md` §2 unless a decision retires them.
3. Small, reviewable commits on a feature branch. **Never push, open PRs, change repo visibility, publish releases or pick a licence without explicit owner approval.**
4. Escape late (`esc_html`, `esc_url`, `esc_attr`, `wp_kses_post`); every user-facing string translatable with text domain `abuobaida`.
5. CSS: logical properties only (`margin-inline-start`, not `margin-left`); tokens from `theme.json`; no new dependencies without a stated reason.
6. Never invent projects, metrics, clients, testimonials or credentials. Ask.
7. State what was verified vs. not verified. Don't claim it works without running it.
8. End of session: update `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8 log, and `DECISIONS.md` if anything was decided.

## Key files
`docs/implementation/` → `AUDIT.md`, `IMPLEMENTATION_PLAN.md`, `DECISIONS.md`, `HANDOFF.md`, `SESSION_INDEX.md`, `SESSION_TEMPLATE.md`, `sessions/NN-*.md`
