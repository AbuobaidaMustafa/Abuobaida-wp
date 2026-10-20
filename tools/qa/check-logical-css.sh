#!/usr/bin/env bash
# Fail when theme CSS uses physical left/right properties, which break the
# Arabic (RTL) layout. Use logical properties instead (MULTILINGUAL.md §5):
#   margin-left → margin-inline-start, left: → inset-inline-start,
#   text-align: left → text-align: start, float: left → float: inline-start …
#
# Usage: tools/qa/check-logical-css.sh [file.css ...]
#   With no arguments, checks every tracked or new .css file except vendor
#   code and the legacy v1 files listed in tools/qa/logical-css-legacy.txt
#   (removed in Sessions 13–14).
# A genuine exception can be kept with a trailing comment: /* physical-ok: reason */
set -euo pipefail
cd "$(git rev-parse --show-toplevel)"

LEGACY_LIST="tools/qa/logical-css-legacy.txt"
if [ "$#" -gt 0 ]; then
	FILES=("$@")
else
	mapfile -t FILES < <(
		{ git ls-files '*.css'; git ls-files --others --exclude-standard '*.css'; } |
		grep -vE '^(assets/vendor|node_modules|vendor|docs|tools)/' |
		grep -vxF -f <(grep -vE '^\s*(#|$)' "$LEGACY_LIST") || true
	)
fi

if [ "${#FILES[@]}" -eq 0 ]; then
	echo "No CSS files to check."
	exit 0
fi

PATTERN='(margin|padding|border)-(left|right)([^a-z-]|$)|(^|[^a-z-])(left|right)[[:space:]]*:|text-align[[:space:]]*:[[:space:]]*(left|right)|(float|clear)[[:space:]]*:[[:space:]]*(left|right)|border-(top|bottom)-(left|right)-radius'

status=0
for file in "${FILES[@]}"; do
	[ -f "$file" ] || continue
	if matches=$(grep -nE "$PATTERN" "$file" | grep -v 'physical-ok'); then
		echo "$matches" | sed "s#^#$file:#"
		status=1
	fi
done

if [ "$status" -ne 0 ]; then
	echo
	echo "Physical direction properties found. Use logical properties (see MULTILINGUAL.md §5)."
else
	echo "Logical CSS check passed (${#FILES[@]} file(s))."
fi
exit "$status"
