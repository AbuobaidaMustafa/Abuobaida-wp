# Project Context (read first in every session)

**Project:** modernise the personal WordPress portfolio theme of **Abuobaida Mustafa**. He is a web developer (PHP, WordPress, Laravel, full-stack) growing into AI/ML engineering, with research in GIS and snow remote sensing.
**Repo:** `AbuobaidaMustafa/Abuobaida-wp` · theme slug and text domain `abuobaida` · live site abuobaida.sd
**Separate from:** the owner's Dropshipping OMS project. Never mix code, docs, repos or sessions (D-04).

## Today (v1)

- A classic theme: the Underscores scaffold (upstream inactive since 2025-09) with the free BootstrapMade *iPortfolio* front-end. The licence forbids publishing it, so it must be replaced.
- The homepage is `page-home.php` (page slug `home`), with ACF groups `about` and `contact_us`, testimonials as `cb/carousel` blocks, and CF7 form #138.
- Measured problems (AUDIT §2):
  - two doctypes on the homepage, and posts with no `<body>`;
  - a fatal error without ACF;
  - content invisible without JS;
  - 433 KB of JS;
  - accent contrast 3.0:1.

## Target (v2)

- A classic theme with `theme.json` v3. No framework, no build step. Logical CSS only. Vanilla deferred JS.
- A companion plugin `abuobaida-core`: `project` and `testimonial` post types, `project_type` (also the capabilities list) and `project_stack` taxonomies, native custom fields with meta boxes. **No ACF in v2** (D-27).
- **Arabic (RTL), English (default, `/`) and Chinese (`/zh/`)** via Polylang free. The front page is `front-page.php`; slug templates don't work for translations.
- Design: direction **A "Survey" chosen** (D-25). No UI code until the full design set passes gate **G1** in S03 (D-18). Canvas link in DESIGN_BRIEF.

## Rules for every session

1. Read only: this file, `SESSION_INDEX.md`, your session file, the DECISIONS IDs it lists, and the code it lists. **Do not redo the audit.**
2. Inspect code before changing it. Preserve the features in PLAN §3 unless a decision retires them.
3. Work on `feature/NN-slug`, in small commits, and push that branch to GitHub for review (D-28). **Never push to `master` or `main`, force-push, open releases, change repository visibility or pick a licence without the owner's explicit approval.**
4. Escape late. Every string is translatable (`abuobaida`). Templates never call `get_field()` or `pll_*()` directly; use `inc/content.php` and `inc/i18n.php`.
5. CSS uses logical properties and `theme.json` tokens only. Content is never hidden without JS. No motion the visitor didn't trigger.
6. **Never invent** projects, clients, metrics, testimonials or credentials. Use visible `[placeholders]` and ask.
7. Verify by running (TEST_STRATEGY §4, definition of done). Report what was and wasn't verified.
8. At the end, update `HANDOFF.md`, `SESSION_INDEX.md`, PLAN §11, and `DECISIONS.md` if anything was decided.

## Docs map (`docs/implementation/`)

| File | Read when |
|---|---|
| `IMPLEMENTATION_PLAN.md` | Scope, gates, dependencies, risks |
| `DECISIONS.md` | Before choosing anything |
| `ARCHITECTURE.md` | Any code session |
| `MULTILINGUAL.md` | Anything that touches text, layout or URLs |
| `CONTENT_STRATEGY.md` | Homepage, About, projects |
| `DESIGN_BRIEF.md` | Any UI session |
| `TEST_STRATEGY.md` + `tools/` | Verifying, or setting up the local environment |
| `AUDIT.md` | Only to look up a cited finding |
