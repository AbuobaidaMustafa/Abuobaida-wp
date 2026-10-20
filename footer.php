<?php
/**
 * The footer for every template: copyright, back-to-top link and the closing
 * of the document opened in header.php.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Abuobaida
 */

?>

<footer id="footer">
	<div class="container">
		<div class="copyright">
			&copy; <?php esc_html_e( 'Copyright', 'abuobaida' ); ?> <strong><span><?php esc_html_e( 'Abuobaida', 'abuobaida' ); ?></span></strong>
		</div>
	</div>
</footer>
<a href="#top" class="back-to-top d-flex align-items-center justify-content-center" aria-label="<?php esc_attr_e( 'Back to top', 'abuobaida' ); ?>"><i class="bi bi-arrow-up-short" aria-hidden="true"></i></a>

<?php wp_footer(); ?>
</body>
</html>
