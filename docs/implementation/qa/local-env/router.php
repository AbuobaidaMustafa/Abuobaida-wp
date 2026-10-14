<?php
/**
 * Router for PHP's built-in web server so WordPress pretty permalinks work.
 *
 * Usage: php -S 127.0.0.1:8080 -t <wordpress-dir> router.php
 *
 * Local development only. Never deploy this file.
 */

$abuobaida_root = rtrim( $_SERVER['DOCUMENT_ROOT'], '/' );
$abuobaida_path = (string) parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );

// Serve real files (CSS, JS, images) directly.
if ( '/' !== $abuobaida_path && is_file( $abuobaida_root . $abuobaida_path ) ) {
	return false;
}

// Directory index, e.g. /wp-admin/.
$abuobaida_dir = $abuobaida_root . rtrim( $abuobaida_path, '/' );
if ( '/' !== $abuobaida_path && is_dir( $abuobaida_dir ) && is_file( $abuobaida_dir . '/index.php' ) ) {
	chdir( $abuobaida_dir );
	require $abuobaida_dir . '/index.php';
	return;
}

chdir( $abuobaida_root );
require $abuobaida_root . '/index.php';
