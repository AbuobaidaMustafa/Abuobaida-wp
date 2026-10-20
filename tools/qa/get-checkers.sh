#!/usr/bin/env bash
# Install PHP_CodeSniffer + WordPress Coding Standards + PHPCompatibility from
# GitHub, for environments where Packagist is blocked (e.g. Claude's cloud
# workspace). On a normal machine, prefer `composer install`.
#
# Usage: eval "$(tools/qa/get-checkers.sh [install-dir])"
#   Prints `export PHPCS=...`, which tools/qa/phpcs-changed.py and the
#   composer-free commands in tools/README.md pick up.
set -euo pipefail
DIR="${1:-$HOME/.cache/abuobaida-phpcs}"
mkdir -p "$DIR"

# Keep in step with composer.json require-dev.
REPOS=(
	"PHPCSStandards/PHP_CodeSniffer 3.13.6"
	"WordPress/WordPress-Coding-Standards 3.4.1"
	"PHPCSStandards/PHPCSUtils 1.2.3"
	"PHPCSStandards/PHPCSExtra 1.5.1"
	"PHPCompatibility/PHPCompatibility 9.3.5"
	"PHPCompatibility/PHPCompatibilityWP 2.1.8"
	"PHPCompatibility/PHPCompatibilityParagonie 1.3.4"
)
for spec in "${REPOS[@]}"; do
	read -r repo tag <<<"$spec"
	dest="$DIR/$(basename "$repo")"
	[ -d "$dest" ] || git -c advice.detachedHead=false clone -q --depth 1 --branch "$tag" "https://github.com/$repo.git" "$dest" >&2
done

PHPCS_BIN="$DIR/PHP_CodeSniffer/bin/phpcs"
paths="$DIR/WordPress-Coding-Standards,$DIR/PHPCSUtils,$DIR/PHPCSExtra,$DIR/PHPCompatibility,$DIR/PHPCompatibilityWP,$DIR/PHPCompatibilityParagonie"
php "$PHPCS_BIN" --config-set installed_paths "$paths" >/dev/null
echo "export PHPCS=\"php $PHPCS_BIN\""
