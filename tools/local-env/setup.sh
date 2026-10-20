#!/usr/bin/env bash
# Local WordPress for developing this theme, without Docker or MySQL.
#
# WordPress + the official SQLite drop-in, fetched from GitHub only (works where
# Packagist and the npm registry are blocked). The theme is symlinked from this
# repository, so edits show up immediately.
#
# Usage:
#   tools/local-env/setup.sh <target-dir> [--polylang] [--test-data]
#   php -S 127.0.0.1:8080 -t <target-dir>/wp tools/local-env/router.php
#
# Requires: git, php (8.1+, pdo_sqlite), composer (offline `dump-autoload` only), curl.
# Local development only: admin/admin, debug log on, nothing here is production-safe.
set -euo pipefail

TARGET="${1:?Usage: setup.sh <target-dir> [--polylang] [--test-data]}"
shift || true
WITH_POLYLANG=0
WITH_TEST_DATA=0
for arg in "$@"; do
	case "$arg" in
		--polylang) WITH_POLYLANG=1 ;;
		--test-data) WITH_TEST_DATA=1 ;;
		*) echo "Unknown option: $arg" >&2; exit 1 ;;
	esac
done

# Pinned versions (update deliberately, then re-run the baseline).
WP_TAG="${WP_TAG:-7.1.3}"
SQLITE_TAG="${SQLITE_TAG:-v3.1.0}"
ACF_TAG="${ACF_TAG:-6.8.10}"
CF7_TAG="${CF7_TAG:-v6.2.2}"
POLYLANG_TAG="${POLYLANG_TAG:-3.8.11}"
IMPORTER_TAG="${IMPORTER_TAG:-0.9.6}"
WPCLI_VERSION="${WPCLI_VERSION:-2.12.0}"
PORT="${PORT:-8080}"

HERE="$(cd "$(dirname "$0")" && pwd)"
THEME_DIR="$(cd "$HERE/../.." && pwd)"
mkdir -p "$TARGET"
TARGET="$(cd "$TARGET" && pwd)"
WPDIR="$TARGET/wp"
PLUGINS="$WPDIR/wp-content/plugins"

clone() { # repo tag dest
	[ -d "$3" ] || git -c advice.detachedHead=false clone -q --depth 1 --branch "$2" "https://github.com/$1.git" "$3"
}

echo "• WordPress $WP_TAG"
clone WordPress/WordPress "$WP_TAG" "$WPDIR"

echo "• SQLite database integration $SQLITE_TAG"
clone WordPress/sqlite-database-integration "$SQLITE_TAG" "$TARGET/src/sqlite"
if [ ! -d "$PLUGINS/sqlite-database-integration" ]; then
	# The plugin links its database package with a symlink; copy it resolved.
	cp -rL "$TARGET/src/sqlite/packages/plugin-sqlite-database-integration" "$PLUGINS/sqlite-database-integration"
fi
sed -e "s#{SQLITE_IMPLEMENTATION_FOLDER_PATH}#$PLUGINS/sqlite-database-integration#" \
	-e "s#{SQLITE_PLUGIN}#sqlite-database-integration/load.php#" \
	"$PLUGINS/sqlite-database-integration/db.copy" > "$WPDIR/wp-content/db.php"

echo "• WP-CLI $WPCLI_VERSION"
WPCLI="$TARGET/wp-cli.phar"
[ -f "$WPCLI" ] || curl -sSL -o "$WPCLI" "https://github.com/wp-cli/wp-cli/releases/download/v$WPCLI_VERSION/wp-cli-$WPCLI_VERSION.phar"
wp() { php "$WPCLI" --allow-root --path="$WPDIR" "$@" 2> >(grep -v "wp_update_" >&2); }

if [ ! -f "$WPDIR/wp-config.php" ]; then
	mkdir -p "$TARGET/db"
	wp config create --dbname=wp --dbuser=wp --dbpass=wp --skip-check --quiet --extra-php <<PHP
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', '$TARGET/debug.log' );
define( 'WP_DEBUG_DISPLAY', false );
define( 'DB_DIR', '$TARGET/db' );
define( 'WP_ENVIRONMENT_TYPE', 'local' );
define( 'AUTOMATIC_UPDATER_DISABLED', true );
// Keep debug.log meaningful: no update checks or cron calls to wordpress.org.
define( 'WP_HTTP_BLOCK_EXTERNAL', true );
define( 'DISABLE_WP_CRON', true );
PHP
fi

if ! wp core is-installed 2>/dev/null; then
	wp core install --url="http://localhost:$PORT" --title="Abuobaida Mustafa" \
		--admin_user=admin --admin_password=admin --admin_email=admin@example.test --skip-email --quiet
fi
wp option update siteurl "http://localhost:$PORT" --quiet
wp option update home "http://localhost:$PORT" --quiet

echo "• Theme (symlinked from $THEME_DIR)"
[ -e "$WPDIR/wp-content/themes/abuobaida" ] || ln -s "$THEME_DIR" "$WPDIR/wp-content/themes/abuobaida"

echo "• Plugins: ACF $ACF_TAG, Contact Form 7 $CF7_TAG"
clone AdvancedCustomFields/acf "$ACF_TAG" "$PLUGINS/advanced-custom-fields"
clone rocklobster-in/contact-form-7 "$CF7_TAG" "$PLUGINS/contact-form-7"
# ACF has no runtime dependencies; it only needs Composer's autoloader (no network).
(cd "$PLUGINS/advanced-custom-fields" && COMPOSER_ALLOW_SUPERUSER=1 composer dump-autoload --no-dev -q)

mkdir -p "$WPDIR/wp-content/mu-plugins"
cp "$HERE/baseline-acf-fields.php" "$WPDIR/wp-content/mu-plugins/"

wp theme activate abuobaida --quiet
wp plugin activate advanced-custom-fields contact-form-7 --quiet
wp rewrite structure '/%postname%/' --quiet

if [ "$WITH_TEST_DATA" = 1 ]; then
	echo "• Theme unit test data"
	clone WordPress/wordpress-importer "$IMPORTER_TAG" "$PLUGINS/wordpress-importer"
	[ -d "$TARGET/src/theme-test-data" ] || git clone -q --depth 1 https://github.com/WordPress/theme-test-data.git "$TARGET/src/theme-test-data"
	wp plugin activate wordpress-importer --quiet
	wp import "$TARGET/src/theme-test-data/themeunittestdata.wordpress.xml" --authors=create --skip=attachment > /dev/null
fi

echo "• Seeding the homepage"
wp eval-file "$HERE/seed.php"

if [ "$WITH_POLYLANG" = 1 ]; then
	echo "• Polylang $POLYLANG_TAG (installed, not configured; admin JS is not built)"
	clone polylang/polylang "$POLYLANG_TAG" "$PLUGINS/polylang"
	(cd "$PLUGINS/polylang" && COMPOSER_ALLOW_SUPERUSER=1 composer dump-autoload --no-dev -q)
fi

wp rewrite flush --quiet
# Start with an empty log: CLI runs above log harmless update-check and HTTP_HOST notices.
: > "$TARGET/debug.log"
echo
echo "Ready. Serve with:"
echo "  php -S 127.0.0.1:$PORT -t \"$WPDIR\" \"$HERE/router.php\""
echo "Admin: http://localhost:$PORT/wp-admin  (admin / admin)   Debug log: $TARGET/debug.log"
