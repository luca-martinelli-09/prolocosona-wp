<?php
/**
 * Template part for displaying pages without title.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package prolocosona
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php prolocosona_post_thumbnail(); ?>

	<div <?php prolocosona_content_class('entry-content !mt-0'); ?>>
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
