<?php
// LOCAL DEVELOPMENT ONLY. Seeds a local copy of the live homepage, using text visible in the owner's screenshots.
// Personal details (phone, age, personal email) are replaced with placeholders.

$slides = '';
$reviews = array(
	array( 'تعديلات على موقع ووردبرس', 'احترافي جدا انصح به' ),
	array( 'تصميم موقع شخصي', 'صمم لي موقع شخصي على موقع ووردبرس وهو شخص جيد أنصح بالتعامل معه' ),
	array( 'Review 3', 'Placeholder review text for layout baseline.' ),
);
foreach ( $reviews as $r ) {
	$slides .= '<div class="wp-block-cb-slide swiper-slide"><div class="testimonial-item"><h4>' . $r[0] . '</h4><p>' . $r[1] . '</p></div></div>';
}
$content = "<!-- wp:paragraph --><p>Home page content.</p><!-- /wp:paragraph -->\n"
	. '<!-- wp:cb/carousel --><div class="wp-block-cb-carousel">' . $slides . '</div><!-- /wp:cb/carousel -->';

$existing = get_page_by_path( 'home' );
$home_id  = $existing ? $existing->ID : wp_insert_post( array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => 'Home',
	'post_name'    => 'home',
	'post_content' => $content,
) );
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $home_id );

update_field( 'about', array(
	'whoami'  => "Hi ! I 'm Abuobaida Mustafa you can call me 马飞 hhhhhha I'm joking ...ummh unless you know Chinese you escape it , anyhow warm welcome and nice hosting you here.",
	'title'   => 'Full Stack Web Developer',
	'details' => 'ambitious and passionate Web Developer with 1+ years of hands-on experience designing, developing, and implementing applications and solutions using a range of technologies and programming languages. Seeking to leverage broad development experience and hands-on technical expertise in a challenging role as a Full-stack Developer. Moreover Now I\'m Master Student at Lanzhou University as well researcher in the field of GIS and Snow Remote Sensing looking for chance to collaborate , pursuing and do great work .',
	'info'    => array(
		'graduation' => 'Sudanese',
		'phone'      => '+000 000 000 000',
		'city'       => 'Khartoum',
		'age'        => '00',
		'email'      => 'name@example.com',
		'freelancer' => 'Available',
	),
), $home_id );
update_field( 'contact_us', array(
	'loc'   => 'Burri , Khartoum , Sudan',
	'email' => 'info@example.com',
	'call'  => '+000 000 000 000',
	'map'   => 'https://www.google.com/maps/embed?pb=placeholder',
), $home_id );

// Contact Form 7 form with the ID hard-coded in page-home.php.
if ( ! get_post( 138 ) && class_exists( 'WPCF7_ContactFormTemplate' ) ) {
	$id = wp_insert_post( array(
		'import_id'   => 138,
		'post_type'   => 'wpcf7_contact_form',
		'post_status' => 'publish',
		'post_title'  => 'Contact form 1',
	) );
	update_post_meta( $id, '_form', WPCF7_ContactFormTemplate::get_default( 'form' ) );
	update_post_meta( $id, '_mail', WPCF7_ContactFormTemplate::get_default( 'mail' ) );
	update_post_meta( $id, '_messages', WPCF7_ContactFormTemplate::get_default( 'messages' ) );
	echo "CF7 form id: $id\n";
}

// A menu in the registered location so generic templates have something to show.
echo "Home page id: $home_id\n";
