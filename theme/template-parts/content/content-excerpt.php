<?php
/**
 * Template part for displaying post archives and search results.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package prolocosona
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article-list-element' ); ?>>
	<?php prolocosona_post_thumbnail(); ?>

	<div class="flex flex-col gap-3 p-5">
		<header class="thumb-header">
			<?php
                    if (is_sticky() && is_home() && !is_paged()) {
                        printf('%s', esc_html_x('In evidenza', 'post', 'prolocosona'));
                    }
                    the_title(sprintf('<h3 class="thumb-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>');
?>
		</header><!-- .entry-header -->
	
		<div <?php prolocosona_content_class('thumb-content'); ?>>
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-${ID} -->
