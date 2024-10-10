<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no `home.php` file exists.
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

			<?php if (is_home() && !is_front_page()) :
			    ?>
			<header class="page-header">
				<h1 class="page-title"><?php single_post_title(); ?></h1>
			</header><!-- .page-header -->

			<?php  endif; ?>

			<div class="article-list">
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
