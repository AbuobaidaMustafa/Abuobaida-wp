<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Abuobaida
 */

get_header('home');
?>

	<main id="main" class="main">
    <div class="noise"></div>
<div class="overlay"></div>
<div class="terminal">
  <h1>Error <span class="errorcode">404</span></h1>
  <p class="output">The page you are looking for might have been removed, had its name changed or is temporarily unavailable.</p>
  <p class="output">Please try to <a href="/">go back</a> or <a href="/">return to the homepage</a>.</p>
  <p class="output">Good luck.</p>
</div>
</main>
<!-- #main -->


<?php
get_footer('home');
?>