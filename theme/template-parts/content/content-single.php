<?php
/**
 * Template part for displaying single posts.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package prolocosona
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>

		<?php if (!is_page()) : ?>
			<div class="entry-meta">
				<?php prolocosona_entry_meta(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php prolocosona_entry_excerpt(); ?>

	<?php prolocosona_post_thumbnail(); ?>

	<div <?php prolocosona_content_class('entry-content'); ?> id="testo-completo">
		<?php
        the_content(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers. */
                    __('Leggi tutto<span class="sr-only"> "%s"</span>', 'prolocosona'),
                    [
                        'span' => [
                            'class' => [],
                        ],
                    ]
                ),
                get_the_title()
            )
        );

wp_link_pages(
    [
        'before' => '<div>' . __('Pages:', 'prolocosona'),
        'after'  => '</div>',
    ]
);
?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php prolocosona_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-${ID} -->
