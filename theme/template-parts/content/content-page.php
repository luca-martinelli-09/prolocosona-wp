<?php
/**
 * Template part for displaying pages.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package prolocosona
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
        if (!is_front_page()) {
            the_title('<h1 class="entry-title">', '</h1>');
        } else {
            the_title('<h2 class="entry-title">', '</h2>');
        }
?>
	</header><!-- .entry-header -->

	<?php prolocosona_post_thumbnail(); ?>

	<div <?php prolocosona_content_class('entry-content'); ?>>
		<?php
the_content();

wp_link_pages(
    [
        'before' => '<div>' . __('Pages:', 'prolocosona'),
        'after'  => '</div>',
    ]
);
?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
