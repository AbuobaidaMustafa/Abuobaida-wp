<?php
/**
 * Homepage (v1 one-page layout), used for the page with the slug "home".
 *
 * 1.0.1: one document shell, fields read with or without ACF, escaped output,
 * site-relative upload URLs, content visible without JavaScript.
 *
 * @package Abuobaida
 */

get_header();

$abuobaida_about      = abuobaida_v1_group( 'about' );
$abuobaida_contact    = abuobaida_v1_group( 'contact_us' );
$abuobaida_roles      = array( 'PHP Developer', 'WordPress Developer', 'Laravel Developer', 'Freelancer' );
$abuobaida_skills     = array(
	array(
		'HTML'       => 100,
		'CSS'        => 90,
		'JavaScript' => 75,
	),
	array(
		'PHP'           => 80,
		'WordPress/CMS' => 90,
		'Laravel'       => 70,
	),
);
$abuobaida_portfolio  = array(
	array( 'filter-app', 'App 1' ),
	array( 'filter-web', 'Web 3' ),
	array( 'filter-app', 'App 2' ),
	array( 'filter-card', 'Card 2' ),
	array( 'filter-web', 'Web 2' ),
	array( 'filter-app', 'App 3' ),
	array( 'filter-card', 'Card 1' ),
	array( 'filter-card', 'Card 3' ),
	array( 'filter-web', 'Web 3' ),
);
$abuobaida_screenshot = abuobaida_v1_upload_url( '2021/07/screenshot.png' );
?>

	<section id="hero" class="d-flex flex-column justify-content-left align-items-center" style="background-image: url('<?php echo esc_url( abuobaida_v1_upload_url( '2021/07/IMG_20190913_152428.jpg' ) ); ?>');">
		<div class="hero-container" data-aos="fade-in">
			<h1><?php esc_html_e( 'Abuobaida Mustafa', 'abuobaida' ); ?></h1>
			<p><?php esc_html_e( "I'm", 'abuobaida' ); ?> <span class="typed" aria-hidden="true" data-typed-items="PHP Developer, WordPress Developer , Laravel Developer, Freelancer"></span><span class="typed-fallback screen-reader-text"><?php echo esc_html( implode( ', ', $abuobaida_roles ) ); ?></span></p>
		</div>
	</section>

	<main id="main">

		<section id="about" class="about">
			<div class="container">

				<div class="section-title">
					<h2><?php esc_html_e( 'About', 'abuobaida' ); ?></h2>
					<p><?php echo esc_html( $abuobaida_about['whoami'] ); ?></p>
				</div>

				<div class="row">
					<div class="col-lg-4" data-aos="fade-right">
						<img src="<?php echo esc_url( abuobaida_v1_upload_url( '2021/07/IMG_20191229_200945-1.jpg' ) ); ?>" class="img-fluid" alt="<?php esc_attr_e( 'Abuobaida Mustafa', 'abuobaida' ); ?>">
					</div>
					<div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
						<h3><?php echo esc_html( $abuobaida_about['title'] ); ?>.</h3>
						<p class="fst-italic">
							<?php echo esc_html( $abuobaida_about['details'] ); ?>
						</p>
						<div class="row">
							<div class="col-lg-6">
								<ul>
									<li><i class="bi bi-chevron-right" aria-hidden="true"></i> <strong><?php esc_html_e( 'Nationality:', 'abuobaida' ); ?></strong> <span><?php echo esc_html( $abuobaida_about['info']['graduation'] ); ?></span></li>
									<li><i class="bi bi-chevron-right" aria-hidden="true"></i> <strong><?php esc_html_e( 'Phone:', 'abuobaida' ); ?></strong> <span><?php echo esc_html( $abuobaida_about['info']['phone'] ); ?></span></li>
									<li><i class="bi bi-chevron-right" aria-hidden="true"></i> <strong><?php esc_html_e( 'City:', 'abuobaida' ); ?></strong> <span><?php echo esc_html( $abuobaida_about['info']['city'] ); ?></span></li>
								</ul>
							</div>
							<div class="col-lg-6">
								<ul>
									<li><i class="bi bi-chevron-right" aria-hidden="true"></i> <strong><?php esc_html_e( 'Age:', 'abuobaida' ); ?></strong> <span><?php echo esc_html( $abuobaida_about['info']['age'] ); ?></span></li>
									<li><i class="bi bi-chevron-right" aria-hidden="true"></i> <strong><?php esc_html_e( 'Email:', 'abuobaida' ); ?></strong> <span><?php echo esc_html( $abuobaida_about['info']['email'] ); ?></span></li>
									<li><i class="bi bi-chevron-right" aria-hidden="true"></i> <strong><?php esc_html_e( 'Freelance:', 'abuobaida' ); ?></strong> <span><?php echo esc_html( $abuobaida_about['info']['freelancer'] ); ?></span></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

			</div>
		</section>

		<section id="skills" class="skills section-bg">
			<div class="container">

				<div class="section-title">
					<h2><?php esc_html_e( 'Skills', 'abuobaida' ); ?></h2>
				</div>

				<div class="row skills-content">
					<?php foreach ( $abuobaida_skills as $abuobaida_column => $abuobaida_group ) : ?>
						<div class="col-lg-6" data-aos="fade-up"<?php echo $abuobaida_column ? ' data-aos-delay="100"' : ''; ?>>
							<?php foreach ( $abuobaida_group as $abuobaida_skill => $abuobaida_level ) : ?>
								<div class="progress">
									<span class="skill"><?php echo esc_html( $abuobaida_skill ); ?> <i class="val"><?php echo esc_html( $abuobaida_level ); ?>%</i></span>
									<div class="progress-bar-wrap">
										<div class="progress-bar" role="progressbar" aria-label="<?php echo esc_attr( $abuobaida_skill ); ?>" aria-valuenow="<?php echo esc_attr( $abuobaida_level ); ?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endforeach; ?>
				</div>

			</div>
		</section>

		<section id="portfolio" class="portfolio section-bg">
			<div class="container">

				<div class="section-title">
					<h2><?php esc_html_e( 'Portfolio', 'abuobaida' ); ?></h2>
				</div>

				<div class="row" data-aos="fade-up">
					<div class="col-lg-12 d-flex justify-content-center">
						<ul id="portfolio-flters">
							<li data-filter="*" class="filter-active"><?php esc_html_e( 'All', 'abuobaida' ); ?></li>
							<li data-filter=".filter-app"><?php esc_html_e( 'App', 'abuobaida' ); ?></li>
							<li data-filter=".filter-card"><?php esc_html_e( 'Card', 'abuobaida' ); ?></li>
							<li data-filter=".filter-web"><?php esc_html_e( 'Web', 'abuobaida' ); ?></li>
						</ul>
					</div>
				</div>

				<div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">
					<?php foreach ( $abuobaida_portfolio as $abuobaida_item ) : ?>
						<div class="col-lg-4 col-md-6 portfolio-item <?php echo esc_attr( $abuobaida_item[0] ); ?>">
							<div class="portfolio-wrap">
								<img src="<?php echo esc_url( $abuobaida_screenshot ); ?>" class="img-fluid" alt="">
								<div class="portfolio-links">
									<a href="<?php echo esc_url( $abuobaida_screenshot ); ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo esc_attr( $abuobaida_item[1] ); ?>" aria-label="<?php /* translators: %s: portfolio item name. */ echo esc_attr( sprintf( __( 'Enlarge %s', 'abuobaida' ), $abuobaida_item[1] ) ); ?>"><i class="bx bx-plus" aria-hidden="true"></i></a>
									<a href="portfolio-details.html" title="<?php esc_attr_e( 'More Details', 'abuobaida' ); ?>" aria-label="<?php /* translators: %s: portfolio item name. */ echo esc_attr( sprintf( __( 'More details about %s', 'abuobaida' ), $abuobaida_item[1] ) ); ?>"><i class="bx bx-link" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

			</div>
		</section>

		<section id="testimonials" class="testimonials section-bg">
			<div class="container">
				<div class="section-title">
					<h2><?php esc_html_e( 'Testimonials', 'abuobaida' ); ?></h2>
				</div>

				<div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
					<div class="swiper-wrapper">
						<?php
						foreach ( parse_blocks( get_the_content() ) as $abuobaida_block ) {
							if ( 'cb/carousel' === $abuobaida_block['blockName'] ) {
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Core-rendered block HTML from the page content, as the_content() would print it.
								echo render_block( $abuobaida_block );
							}
						}
						?>
					</div>
				</div>
			</div>
		</section>

		<section id="contact" class="contact">
			<div class="container">

				<div class="section-title">
					<h2><?php esc_html_e( 'Contact', 'abuobaida' ); ?></h2>
				</div>

				<div class="row" data-aos="fade-in">

					<div class="col-lg-5 d-flex align-items-stretch">
						<div class="info">
							<div class="address">
								<i class="bi bi-geo-alt" aria-hidden="true"></i>
								<h4><?php esc_html_e( 'Location:', 'abuobaida' ); ?></h4>
								<p><?php echo esc_html( $abuobaida_contact['loc'] ); ?></p>
							</div>

							<div class="email">
								<i class="bi bi-envelope" aria-hidden="true"></i>
								<h4><?php esc_html_e( 'Email:', 'abuobaida' ); ?></h4>
								<p><?php echo esc_html( $abuobaida_contact['email'] ); ?></p>
							</div>

							<div class="phone">
								<i class="bi bi-phone" aria-hidden="true"></i>
								<h4><?php esc_html_e( 'Call:', 'abuobaida' ); ?></h4>
								<p><?php echo esc_html( $abuobaida_contact['call'] ); ?></p>
							</div>
							<?php if ( $abuobaida_contact['map'] ) : ?>
								<iframe src="<?php echo esc_url( $abuobaida_contact['map'] ); ?>" title="<?php esc_attr_e( 'Location map', 'abuobaida' ); ?>" loading="lazy" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
							<?php endif; ?>
						</div>

					</div>

					<div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
						<?php
						$abuobaida_form_id = abuobaida_v1_contact_form_id();
						if ( $abuobaida_form_id && shortcode_exists( 'contact-form-7' ) ) {
							echo do_shortcode( sprintf( '[contact-form-7 id="%d"]', $abuobaida_form_id ) );
						}
						?>
					</div>

				</div>

			</div>
		</section>

	</main>

<?php
get_footer();
