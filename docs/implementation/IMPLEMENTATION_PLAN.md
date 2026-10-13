# Implementation Plan — Abuobaida Portfolio Theme

Master roadmap. Audit details: `AUDIT.md`. Decisions: `DECISIONS.md`. Current state: `HANDOFF.md`.

## 1. Goal

Evolve the existing `abuobaida` theme into a modern, trilingual (Arabic / English / Chinese), accessible, performant classic WordPress theme that presents real projects and case studies, and publish it as a clean public repository — without losing any existing feature or content.

## 2. Feature inventory (must be preserved or explicitly retired)

| ID | Feature | Today | Target |
|---|---|---|---|
| F-01 | Hero: name + roles | Hard-coded; Typed.js rotation | Editable fields; static role line (no animation dependency) |
| F-02 | About | ACF `about` group (whoami, title, details, info{graduation, phone, city, age, email, freelancer}) | Same data, translatable; personal-detail visibility per D-06 |
| F-03 | Skills | Hard-coded % bars | Grouped skill list (no percentages) — content from fields |
| F-04 | Portfolio grid + filter + lightbox | Hard-coded placeholders, Isotope, GLightbox | `project` CPT; selected projects on home; archive with progressive-enhancement filter |
| F-05 | Project details | Link to non-existent page | `single-project.php` case-study template |
| F-06 | Testimonials | `cb/carousel` blocks in page content (Mostaql reviews) | Preserved content; accessible presentation (D-09) |
| F-07 | Contact | ACF `contact_us` (loc, email, call, map) + CF7 #138 + map iframe | Same; CF7 form per language; map loaded on demand |
| F-08 | Navigation | Fixed sidebar, hard-coded anchors, mobile `<i>` toggle | `wp_nav_menu` on registered location, accessible disclosure, language switcher |
| F-09 | Social links / profile photo | Hard-coded, dead `#` links | Fields/Customizer; only real links rendered |
| F-10 | Resume download | Hard-coded uploads URL | Field (file), one PDF per language if available |
| F-11 | Back to top | JS + icon font | Plain anchor link, no JS required |
| F-12 | 404 page | Terminal style, remote GIF | Terminal concept kept, self-contained, translatable |
| F-13 | Blog templates (index/single/archive/search/comments) | Broken markup | Working, styled with the design system (scope per D-07) |
| F-14 | `_s` supports (title-tag, logo, background, header, Customizer, widgets, Jetpack) | Present | Keep what is used; retire unused ones only with approval |
| F-15 | Translation readiness | `.pot` exists | Full i18n: theme strings ar / en / zh_CN; content via multilingual plugin |

## 3. Ranked improvements

| Rank | Improvement | Fixes | Session |
|---|---|---|---|
| 1 | Replace licence-encumbered iPortfolio layer and stock assets | P-01 | 07–12, 14 |
| 2 | Fix document structure in headers/footers | P-02, P-03 | 03 |
| 3 | Real project content model + case studies | P-04 | 06, 10, 11 |
| 4 | ACF guards, escaping, remove hard-coded URLs | P-05, P-07, P-11 | 03 |
| 5 | Trilingual + RTL foundation | new requirement | 05, 08, 15 |
| 6 | Design system (tokens, type, components) | visual quality | 04, 05 |
| 7 | Remove Bootstrap & 10 vendor libraries; self-host fonts | P-08 | progressive, closed in 13 |
| 8 | Accessibility (nav, names, headings, motion, focus) | P-09 | every UI session; audited in 16 |
| 9 | Content accuracy & privacy | P-06, P-10 | 01 (decisions), 09 |
| 10 | Repo hygiene, tooling, README, licence | P-12, P-13 | 02, 17 |

## 4. Design direction (recommended)

**"Engineering notebook" — editorial, typography-led, light-first.**

- Layout: top navigation instead of the 300 px fixed sidebar; generous single-column reading width for prose, a 12-column grid for project lists.
- Type: one humanist sans for text and headings + a monospace for technical metadata (stack, dates, roles) — continuity with the current Roboto Mono identity and the terminal 404. Font choice must cover Latin, Arabic and CJK (see D-10).
- Colour: near-neutral paper/ink palette with **one** accent; a second, quieter accent reserved for AI/ML project tags. Dark mode only if the design session shows a reason (D-11).
- Projects lead: real screenshots, role, stack chips, outcome line. No percentages, no typing animation, no scroll-reveal.
- Personality kept in small, deliberate places: the terminal 404, monospace metadata, the conversational About intro.

**Why**: your credibility comes from shipped work and technical depth, which a reading-first layout presents best; it renders cleanly in RTL and CJK (decoration-heavy styles break first under translation); and it is cheap to implement without a framework.

Alternatives considered (to be mocked in Session 04): *Dark terminal/dev* (strong continuity, but contrast-fragile and common among developer portfolios); *Classic CV* (credible but forgettable).

## 5. Proposed architecture

Classic theme + `theme.json` (v3). No build step initially; plain CSS with custom properties and **logical properties only** (so one stylesheet serves LTR and RTL); small vanilla JS modules loaded only where used.

```
abuobaida/
├── style.css                 # theme header + minimal base
├── theme.json                # design tokens (colour, type scale, spacing, layout widths)
├── functions.php             # loads inc/* only
├── inc/
│   ├── setup.php             # supports, menus, image sizes, textdomain
│   ├── assets.php            # enqueue (conditional per template), fonts, preload
│   ├── acf.php               # safe field helpers, acf-json save/load paths
│   ├── i18n.php              # language switcher helpers, multilingual-plugin adapter
│   ├── template-tags.php
│   └── template-functions.php
├── acf-json/                 # versioned field groups
├── template-parts/
│   ├── site/                 # header, footer, nav, language-switcher
│   ├── home/                 # hero, about, skills, projects, testimonials, contact
│   └── components/           # section-header, project-card, button, tag-list
├── front-page.php · page.php · single.php · single-project.php · archive-project.php
├── index.php · archive.php · search.php · 404.php · comments.php
├── assets/{css,js,fonts,icons,img}
├── languages/                # abuobaida.pot, ar.po/mo, zh_CN.po/mo
└── docs/
```

Project content model: `project` post type + `project_type` taxonomy (Web / WordPress / Laravel / AI-ML…) + case-study fields in ACF. **Where the post type lives is D-05** (recommended: small companion plugin, so content survives a theme switch).

Multilingual: **Polylang** recommended (D-08). Theme talks to it only through `inc/i18n.php` so the theme still works without it.

## 6. Phased roadmap

| Phase | Sessions | Outcome |
|---|---|---|
| 0 Audit & baseline | 00 ✅, 01 | Audit, plan, baseline screenshots, ACF/plugin/content export |
| 1 Requirements & design | 04, 05 | Chosen direction; design system & tokens incl. RTL/CJK |
| 2 Technical foundation | 02, 03, 06 | Tooling, critical fixes on current theme, content model |
| 3 Shared interface | 07, 08 | New shell (header/nav/footer), language switcher & RTL |
| 4 Homepage | 09 | New homepage sections using real content |
| 5 Projects | 10, 11 | Project archive/filter; case-study template |
| 6 Other templates & features | 12 | page/post/archive/search/404/comments |
| 7 Quality & performance | 13, 16 | Vendor removal, performance, a11y + regression QA |
| 8 Release | 15, 17 | Translations complete; README, licence, release checklist |

## 7. Sessions and dependencies

| # | Session | Depends on | Status |
|---|---|---|---|
| 00 | Audit & planning | — | ✅ Done |
| 01 | Baseline & content inventory | 00 | Waiting for owner input |
| 02 | Repo hygiene & dev tooling | 00 | ⏳ Next |
| 03 | Critical fixes on current theme | 01, 02 | Pending |
| 04 | Design direction exploration | 01 | Pending |
| 05 | Design system & tokens (incl. RTL/CJK) | 04 | Pending |
| 06 | Project content model | 01, 03 | Pending |
| 07 | Site shell: header, nav, footer | 05, 03 | Pending |
| 08 | Multilingual foundation & RTL | 07 | Pending |
| 09 | Homepage sections | 06, 08 | Pending |
| 10 | Project archive & filtering | 06, 08 | Pending |
| 11 | Project case-study template | 10 | Pending |
| 12 | Generic templates & 404 | 07 | Pending |
| 13 | Vendor removal & performance | 09–12 | Pending |
| 14 | Asset & licence clean-up | 13 | Pending |
| 15 | Translation completion (ar, zh_CN) | 09–12 | Pending |
| 16 | Accessibility & regression QA | 13, 15 | Pending |
| 17 | Public release preparation | 14, 16 | Pending |

Parallelisable: 02 ∥ 01; 04 ∥ 03; 10 ∥ 12 once 08 is done.

## 8. Progress log

| Date | Session | Result |
|---|---|---|
| 2026-10-14 | 00 | Audit, plan and session docs written on local branch `docs/modernization-plan`. Not pushed. |
