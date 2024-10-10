<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package prolocosona
 */

get_header();
?>

	<section id="primary">
		<main id="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				printf(
					/* translators: 1: search result title. 2: search term. */
					'<h1 class="page-title">%1$s <span>%2$s</span></h1>',
					esc_html__( 'Risultati di ricerca per:', 'prolocosona' ),
					get_search_query()
				);
				?>
			</header><!-- .page-header -->

			<div class="article-list mt-5 lg:mt-10">
			<?php
            // Start the Loop.
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content/content', 'excerpt');

                // End the loop.
            endwhile;
		    ?>
						</div>
							<?php
		                // Previous/next page navigation.
		                prolocosona_the_posts_navigation();
		    ?>
<?php

		else :

		    // If no content, include the "No posts found" template.
		    get_template_part('template-parts/content/content', 'none');

		endif;
?>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
