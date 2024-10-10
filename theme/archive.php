<?php
/**
 * The template for displaying archive pages.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package prolocosona
 */
get_header();
?>

	<section id="primary">
		<main id="main">

		<?php if (have_posts()) : ?>

			<header class="page-header">
				<?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
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
