<?php
/**
 * LOCAL BASELINE ONLY — field groups inferred from page-home.php usage.
 * get_field('about') → whoami, title, details, info{graduation, phone, city, age, email, freelancer}
 * get_field('contact_us') → loc, email, call, map
 */
add_action( 'acf/include_fields', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	$sub = function ( $prefix, $names, $type = 'text' ) {
		$out = array();
		foreach ( $names as $n ) {
			$out[] = array( 'key' => "field_{$prefix}_{$n}", 'name' => $n, 'label' => ucfirst( $n ), 'type' => $type );
		}
		return $out;
	};
	acf_add_local_field_group( array(
		'key'      => 'group_home_inferred',
		'title'    => 'Home (inferred)',
		'fields'   => array(
			array(
				'key' => 'field_about', 'name' => 'about', 'label' => 'About', 'type' => 'group',
				'sub_fields' => array_merge(
					$sub( 'about', array( 'whoami', 'title' ) ),
					$sub( 'about', array( 'details' ), 'textarea' ),
					array( array(
						'key' => 'field_about_info', 'name' => 'info', 'label' => 'Info', 'type' => 'group',
						'sub_fields' => $sub( 'info', array( 'graduation', 'phone', 'city', 'age', 'email', 'freelancer' ) ),
					) )
				),
			),
			array(
				'key' => 'field_contact_us', 'name' => 'contact_us', 'label' => 'Contact us', 'type' => 'group',
				'sub_fields' => $sub( 'contact', array( 'loc', 'email', 'call', 'map' ) ),
			),
		),
		'location' => array( array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ) ),
	) );
} );
