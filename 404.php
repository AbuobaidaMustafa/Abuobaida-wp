<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://developer.wordpress.org/themes/functionality/404-pages/
 *
 * @package Abuobaida
 */

get_header();
?>

	<main id="main" class="main">
		<div class="noise" aria-hidden="true"></div>
		<div class="overlay" aria-hidden="true"></div>
		<div class="terminal">
			<h1><?php esc_html_e( 'Error', 'abuobaida' ); ?> <span class="errorcode">404</span></h1>
			<p class="output"><?php esc_html_e( 'The page you are looking for might have been removed, had its name changed or is temporarily unavailable.', 'abuobaida' ); ?></p>
			<p class="output">
				<?php
				printf(
					/* translators: 1: link to the previous page, 2: link to the homepage. */
					esc_html__( 'Please try to %1$s or %2$s.', 'abuobaida' ),
					'<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'go back', 'abuobaida' ) . '</a>',
					'<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'return to the homepage', 'abuobaida' ) . '</a>'
				);
				?>
			</p>
			<p class="output"><?php esc_html_e( 'Good luck.', 'abuobaida' ); ?></p>
		</div>
	</main>

<?php
get_footer();
