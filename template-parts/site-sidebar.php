<?php
/**
 * Site sidebar: profile, social links and section navigation (v1 layout).
 *
 * Shared by every template since 1.0.1. On the front page the section links
 * are in-page anchors; elsewhere they point back to the homepage sections.
 *
 * @package Abuobaida
 */

$abuobaida_social = abuobaida_v1_social_links();
?>
<button type="button" class="mobile-nav-toggle d-xl-none" aria-controls="header" aria-expanded="false" aria-label="<?php esc_attr_e( 'Menu', 'abuobaida' ); ?>">
	<i class="bi bi-list" aria-hidden="true"></i>
</button>

<header id="header">
	<div class="d-flex flex-column">

		<div class="profile">
			<img src="<?php echo esc_url( abuobaida_v1_upload_url( '2021/07/WeChat-Image_20201219110230.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Abuobaida Mustafa', 'abuobaida' ); ?>" class="img-fluid rounded-circle">
			<h1 class="text-light"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Abuobaida Mustafa', 'abuobaida' ); ?></a></h1>
			<div class="social-links mt-3 text-center">
				<?php foreach ( $abuobaida_social as $abuobaida_network ) : ?>
					<a href="<?php echo esc_url( $abuobaida_network['url'] ); ?>" class="<?php echo esc_attr( $abuobaida_network['class'] ); ?>" aria-label="<?php echo esc_attr( $abuobaida_network['label'] ); ?>"><i class="<?php echo esc_attr( $abuobaida_network['icon'] ); ?>" aria-hidden="true"></i></a>
				<?php endforeach; ?>
			</div>
		</div>

		<nav id="navbar" class="nav-menu navbar" aria-label="<?php esc_attr_e( 'Main', 'abuobaida' ); ?>">
			<ul>
				<li><a href="<?php echo esc_url( abuobaida_v1_section_url( 'hero' ) ); ?>" class="nav-link scrollto active"><i class="bx bx-home" aria-hidden="true"></i> <span><?php esc_html_e( 'Home', 'abuobaida' ); ?></span></a></li>
				<li><a href="<?php echo esc_url( abuobaida_v1_section_url( 'about' ) ); ?>" class="nav-link scrollto"><i class="bx bx-user" aria-hidden="true"></i> <span><?php esc_html_e( 'About', 'abuobaida' ); ?></span></a></li>
				<li><a href="<?php echo esc_url( abuobaida_v1_section_url( 'portfolio' ) ); ?>" class="nav-link scrollto"><i class="bx bx-book-content" aria-hidden="true"></i> <span><?php esc_html_e( 'Portfolio', 'abuobaida' ); ?></span></a></li>
				<li><a href="<?php echo esc_url( abuobaida_v1_section_url( 'contact' ) ); ?>" class="nav-link scrollto"><i class="bx bx-envelope" aria-hidden="true"></i> <span><?php esc_html_e( 'Contact', 'abuobaida' ); ?></span></a></li>
				<li><a href="<?php echo esc_url( abuobaida_v1_upload_url( '2021/07/Abuobaida-Mustafa.pdf' ) ); ?>" class="nav-link scrollto" target="_blank" rel="noopener"><i class="bi bi-download" aria-hidden="true"></i> <span><?php esc_html_e( 'Download Resume', 'abuobaida' ); ?></span></a></li>
			</ul>
		</nav>
	</div>
</header>
