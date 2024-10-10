<?php
/**
 * Template part for displaying the footer content.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package prolocosona
 */
?>

<footer id="colophon" class="py-5 px-3 bg-secondary text-secondary-foreground mt-10">
	<div class="max-w-content mx-auto">
		<?php if (is_active_sidebar('sidebar-1')) : ?>
			<aside role="complementary" class="prose prose-neutral prose-invert prose-sm prose-ul:list-none prose-ul:p-0 prose-li:p-0" aria-label="<?php esc_attr_e('Footer', 'prolocosona'); ?>">
				<?php dynamic_sidebar('sidebar-1'); ?>
			</aside>
		<?php endif; ?>
	</div>
</footer><!-- #colophon -->

<div class="bg-secondary-darker text-secondary-foreground px-3 py-3">
	<p class="max-w-content mx-auto text-xs">
		<?php
            printf(
                '<a href="%1$s">Realizzato da <strong>%2$s</strong></a>',
                esc_url(__('https://w3id.org/people/lucamartinelli', 'prolocosona')),
                'Luca Martinelli'
            );
?>
	</p>
</div>