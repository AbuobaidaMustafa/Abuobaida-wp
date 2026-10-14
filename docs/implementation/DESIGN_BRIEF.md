# Design Brief and Pre-design Review

**Canvas:** *Portfolio Theme Pre-design* in Claude Design: <https://claude.ai/artifact/DF4jsBp8VwhkEZWAERxXzK>
The link is private to the owner until shared from the page's Share menu.

**Status:** awaiting owner review (Session 02). Decisions: D-18 (gate, confirmed), D-25 (direction, recommended), D-10, D-11, D-15.

## 1. Brief

- **Subject:** the portfolio of a full-stack web developer (PHP, WordPress, Laravel) growing into AI/ML engineering, with research in GIS and snow remote sensing, published in Arabic, English and Chinese.
- **Primary job:** show real work credibly and get contacted.
- **Constraints:**
  - typography that works in three scripts;
  - correct RTL;
  - WCAG 2.2 AA;
  - no motion the visitor didn't trigger;
  - no framework;
  - real content only.

## 2. What the canvas contains

| Row | Artboards |
|---|---|
| A: Survey (recommended) | Home EN desktop · Home EN phone · **Home AR (RTL)** · **Phone menu open (ZH)** · Project case study · Tokens and components |
| B: Console | Home EN desktop · Home EN phone |
| C: Two Rivers | Home EN desktop · Home EN phone |

Every board uses the real content available: the owner's positioning, the two Mostaql reviews, the public email and GitHub. Unknowns are `[bracketed placeholders]`. The Arabic and Chinese copy is a **draft translation for review**.

## 3. The three directions

| | A · Survey | B · Console | C · Two Rivers |
|---|---|---|---|
| Idea | A light editorial page. The name set in three scripts over contour lines drawn from the owner's snow-remote-sensing research. | A developer terminal: `whoami`, `ls ./work`. Extends today's monospace identity and the terminal 404. | Today's sidebar, reimagined as a bold identity panel in Nile teal and Yellow-River ochre (Khartoum and Lanzhou). |
| Palette | Snowfield `#F5F7F8`, Ink `#16202A`, Basalt `#4A5763`, Survey blue `#0B5FA5`, Glacier `#E3EEF3`, Contour `#C5D1D8` | Deep slate `#0F1B24`, text `#E6EDF2`, amber `#F2A93B`, teal `#7FD1C8` | White, teal `#12474F`, ochre `#E8C27A` / `#9A6216`, sand `#F4E3C1` |
| Type | Readex Pro (Latin and Arabic in one family) + system CJK | JetBrains Mono + IBM Plex Sans / Plex Sans Arabic + CJK | Alexandria (Latin and Arabic display) + IBM Plex Sans Arabic + CJK |
| Visual hierarchy | Name first, then the statement, then the work. The contour motif is the only decoration. | The prompt and terminal lines carry it. Everything is monospace, so headings have less contrast. | The identity panel dominates; content sits second. |
| Project presentation | One large featured project, then a grid. Best for case studies. | A table, like `ls -l`. Dense and scannable, but weak on visuals. | A two-column card grid. |
| Phones | Top bar with a Menu button; one column; full-width buttons. | The same, but tables collapse to a list. | The panel becomes a tall header that pushes the work below the first screen. |
| Arabic and Chinese | **Strong.** One family covers Latin and Arabic with consistent weight, and the layout mirrors cleanly. | **Weak.** No Arabic monospace exists, so the terminal metaphor breaks in RTL and CJK. | Good type, but a fixed panel plus RTL mirroring is more complex. |
| Accessibility | All text ≥ 4.5:1 (checked) | All text ≥ 4.5:1. Dark UI needs care with focus rings. | Ochre text only at `#9A6216` (5.1:1); `#B7791F` only for large display |
| Implementation cost | Lowest: top nav, simple grid, one SVG motif | Low to medium: tables need responsive care | Highest: sticky panel, RTL panel swap, phone collapse |
| Continuity with today | The blue accent, darkened to pass AA | Mono identity and the 404 | The sidebar layout |
| Risk | Could feel quiet. The contour hero and the name stack carry the identity. | Reads as a generic developer portfolio. Ignores the Arabic audience. | The panel eats laptop width, which is today's problem. |

**Recommendation: A, Survey.** It reads best in all three scripts, puts projects first, costs least to build and maintain, and its one memorable element (three scripts over research contours) is specific to the owner rather than a style trend.

If the owner prefers B's or C's personality, the recommended mix is A's layout and type, with B's terminal treatment kept for the 404 page only, or C's teal and ochre palette as an alternative colourway.

## 4. Design principles (whatever direction is chosen)

1. The work is the hero. Projects appear immediately after the introduction.
2. One memorable element, everything else quiet.
3. The same structure in every language. Mirrored for Arabic, never redesigned.
4. Motion only in response to the visitor (opening the menu, focus).
5. Every claim is linked to evidence: a project, a review or the résumé.

## 5. Approval checklist (gate G1, closed in Session 03)

- [ ] Direction chosen (A, B, C or a named mix), recorded as D-25 confirmed.
- [ ] Homepage approved: desktop, phone, Arabic, Chinese.
- [ ] Project case study approved.
- [ ] Project archive with filter, About page, article/post, 404 and contact form states designed and approved (designed in S03).
- [ ] Tokens approved: colours with contrast, type scale per script, spacing, components and states.
- [ ] Open content items acknowledged: Arabic name spelling, 马飞, photo, availability line (Q-10).
- [ ] The owner confirms there is nothing in the design that the content can't support.

## 6. How to give feedback

Comment directly on the artboards in the canvas, or reply in a session with notes like: "A, but with C's colours", "B for the 404", "no Chinese name", "bigger project images".

S02 applies the feedback. S03 then completes the remaining pages for the chosen direction.
