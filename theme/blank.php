<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default. Please note that
 * this is the WordPress construct of pages: specifically, posts with a post
 * type of `page`.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package prolocosona
 */
/*

Template Name: Pagina senza titolo

*/

get_header();
?>

	<section id="primary">
		<main id="main">

			<?php
            /* Start the Loop */
            while (have_posts()) :
                the_post();

                get_template_part('template-parts/content/content', 'blank');

            endwhile; // End of the loop.
?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();

