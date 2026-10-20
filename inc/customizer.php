<?php
/**
 * Abuobaida Theme Customizer
 *
 * @package Abuobaida
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function abuobaida_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'abuobaida_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'abuobaida_customize_partial_blogdescription',
			)
		);
	}

	abuobaida_customize_register_profile( $wp_customize );
}
add_action( 'customize_register', 'abuobaida_customize_register' );

/**
 * Customizer section for the sidebar's social links and the homepage form.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function abuobaida_customize_register_profile( $wp_customize ) {
	$wp_customize->add_section(
		'abuobaida_profile',
		array(
			'title'       => __( 'Social links and contact form', 'abuobaida' ),
			'description' => __( 'Profile URLs for the sidebar icons. An empty field keeps the icon without a destination.', 'abuobaida' ),
			'priority'    => 120,
		)
	);

	$networks = array(
		'twitter'   => __( 'Twitter URL', 'abuobaida' ),
		'facebook'  => __( 'Facebook URL', 'abuobaida' ),
		'instagram' => __( 'Instagram URL', 'abuobaida' ),
		'skype'     => __( 'Skype URL', 'abuobaida' ),
		'linkedin'  => __( 'LinkedIn URL', 'abuobaida' ),
	);
	foreach ( $networks as $key => $label ) {
		$wp_customize->add_setting(
			'abuobaida_social_' . $key,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			'abuobaida_social_' . $key,
			array(
				'label'   => $label,
				'section' => 'abuobaida_profile',
				'type'    => 'url',
			)
		);
	}

	$wp_customize->add_setting(
		'abuobaida_contact_form_id',
		array(
			'default'           => 138,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'abuobaida_contact_form_id',
		array(
			'label'       => __( 'Contact Form 7 form ID', 'abuobaida' ),
			'description' => __( 'The form shown in the homepage Contact section.', 'abuobaida' ),
			'section'     => 'abuobaida_profile',
			'type'        => 'number',
		)
	);
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function abuobaida_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function abuobaida_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function abuobaida_customize_preview_js() {
	wp_enqueue_script( 'abuobaida-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), ABUOBAIDA_VERSION, true );
}
add_action( 'customize_preview_init', 'abuobaida_customize_preview_js' );
