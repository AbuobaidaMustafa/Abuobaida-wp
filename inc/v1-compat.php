<?php
/**
 * Helpers for the v1 one-page layout (1.0.1 hotfix).
 *
 * They remove the hard dependency on ACF, environment-bound URLs and
 * hard-coded IDs without changing what the page looks like. The v2 rebuild
 * replaces this file (see docs/implementation).
 *
 * @package Abuobaida
 */

/**
 * Homepage field groups and their sub-fields, as stored by ACF.
 *
 * ACF saves a group's sub-fields as plain post meta named
 * "{group}_{sub}" (and "{group}_{sub}_{subsub}" for nested groups), so the
 * values can be read without ACF.
 *
 * @return array<string, array>
 */
function abuobaida_v1_field_schema() {
	return array(
		'about'      => array(
			'whoami'  => true,
			'title'   => true,
			'details' => true,
			'info'    => array(
				'graduation' => true,
				'phone'      => true,
				'city'       => true,
				'age'        => true,
				'email'      => true,
				'freelancer' => true,
			),
		),
		'contact_us' => array(
			'loc'   => true,
			'email' => true,
			'call'  => true,
			'map'   => true,
		),
	);
}

/**
 * Returns a homepage field group as a nested array, with ACF or without it.
 *
 * Every key in the schema is always present (empty string when unset), so
 * templates never trigger "array offset on null" warnings.
 *
 * @param string   $group   Group name: 'about' or 'contact_us'.
 * @param int|null $post_id Post ID; defaults to the current post.
 * @return array
 */
function abuobaida_v1_group( $group, $post_id = null ) {
	$schema = abuobaida_v1_field_schema();
	if ( ! isset( $schema[ $group ] ) ) {
		return array();
	}
	$post_id = $post_id ? (int) $post_id : (int) get_the_ID();

	$values = null;
	if ( function_exists( 'get_field' ) ) {
		$values = get_field( $group, $post_id );
	}

	return abuobaida_v1_fill_group( $schema[ $group ], is_array( $values ) ? $values : null, $group, $post_id );
}

/**
 * Fills a group from ACF values when available, otherwise from post meta.
 *
 * @param array      $schema  Sub-field schema.
 * @param array|null $values  Values returned by ACF, or null to read post meta.
 * @param string     $prefix  Meta key prefix for this level.
 * @param int        $post_id Post ID.
 * @return array
 */
function abuobaida_v1_fill_group( $schema, $values, $prefix, $post_id ) {
	$result = array();
	foreach ( $schema as $key => $child ) {
		$value = is_array( $values ) && array_key_exists( $key, $values ) ? $values[ $key ] : null;
		if ( is_array( $child ) ) {
			$result[ $key ] = abuobaida_v1_fill_group( $child, is_array( $value ) ? $value : null, $prefix . '_' . $key, $post_id );
			continue;
		}
		if ( null === $values ) {
			$value = get_post_meta( $post_id, $prefix . '_' . $key, true );
		}
		$result[ $key ] = is_scalar( $value ) ? (string) $value : '';
	}
	return $result;
}

/**
 * URL of a file in the uploads folder, on the current site's scheme and host.
 *
 * Replaces hard-coded http://abuobaida.sd/wp-content/uploads/... links, which
 * caused mixed content on HTTPS and broke on any other host.
 *
 * @param string $path Path relative to the uploads base, e.g. '2021/07/photo.jpg'.
 * @return string
 */
function abuobaida_v1_upload_url( $path ) {
	$uploads = wp_get_upload_dir();
	$url     = trailingslashit( $uploads['baseurl'] ) . ltrim( $path, '/' );

	/**
	 * Filters the URL of a v1 upload, e.g. to point at a CDN or a new file.
	 *
	 * @param string $url  Full URL.
	 * @param string $path Path relative to the uploads base.
	 */
	return apply_filters( 'abuobaida_v1_upload_url', $url, $path );
}

/**
 * Link to a homepage section: an in-page anchor on the front page, the
 * homepage URL with the anchor everywhere else.
 *
 * @param string $section Section ID, e.g. 'about'.
 * @return string
 */
function abuobaida_v1_section_url( $section ) {
	return is_front_page() ? '#' . $section : home_url( '/#' . $section );
}

/**
 * Social links shown in the sidebar, with URLs from the Customizer.
 *
 * A network without a URL keeps the old "#" link so the sidebar looks the
 * same until real profile URLs are entered (Customizer → Social links).
 *
 * @return array<int, array{url: string, class: string, icon: string, label: string}>
 */
function abuobaida_v1_social_links() {
	$networks = array(
		'twitter'   => array( 'bx bxl-twitter', __( 'Twitter', 'abuobaida' ), 'twitter' ),
		'facebook'  => array( 'bx bxl-facebook', __( 'Facebook', 'abuobaida' ), 'facebook' ),
		'instagram' => array( 'bx bxl-instagram', __( 'Instagram', 'abuobaida' ), 'instagram' ),
		'skype'     => array( 'bx bxl-skype', __( 'Skype', 'abuobaida' ), 'google-plus' ),
		'linkedin'  => array( 'bx bxl-linkedin', __( 'LinkedIn', 'abuobaida' ), 'linkedin' ),
	);

	$links = array();
	foreach ( $networks as $key => $network ) {
		$links[] = array(
			'url'   => get_theme_mod( 'abuobaida_social_' . $key, '' ) ? get_theme_mod( 'abuobaida_social_' . $key ) : '#',
			'icon'  => $network[0],
			'label' => $network[1],
			'class' => $network[2],
		);
	}
	return $links;
}

/**
 * ID of the Contact Form 7 form on the homepage.
 *
 * @return int
 */
function abuobaida_v1_contact_form_id() {
	/**
	 * Filters the Contact Form 7 form ID used on the homepage.
	 *
	 * @param int $form_id Default 138, the form used on the live site.
	 */
	return (int) apply_filters( 'abuobaida_contact_form_id', (int) get_theme_mod( 'abuobaida_contact_form_id', 138 ) );
}

/**
 * Swaps the `no-js` class on <html> for `js` before any CSS applies, so
 * content that waits for scripts is only hidden when scripts can run.
 */
function abuobaida_v1_js_class() {
	wp_print_inline_script_tag( "document.documentElement.classList.replace('no-js','js');" );
}
add_action( 'wp_head', 'abuobaida_v1_js_class', 0 );

/**
 * Prints the theme's favicons when no Site Icon is set in the Customizer.
 *
 * The old <link href="assets/img/favicon.png"> was relative to each page URL
 * and returned 404 everywhere except the site root.
 */
function abuobaida_v1_favicons() {
	if ( has_site_icon() ) {
		return;
	}
	$base = get_template_directory_uri() . '/assets/img/';
	printf( '<link rel="icon" href="%s">' . "\n", esc_url( $base . 'favicon.png' ) );
	printf( '<link rel="apple-touch-icon" href="%s">' . "\n", esc_url( $base . 'apple-touch-icon.png' ) );
}
add_action( 'wp_head', 'abuobaida_v1_favicons' );
