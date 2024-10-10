<?php
/**
 * Template part for displaying a message when posts are not found.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package prolocosona
 */
?>

<section>

	<header class="page-header">
		<?php if (is_search()) : ?>

			<h1 class="page-title">
				<?php
                printf(
                    /* translators: 1: search result title. 2: search term. */
                    '<h1 class="page-title">%1$s <span>%2$s</span></h1>',
                    esc_html__('Risultati di ricerca per:', 'prolocosona'),
                    get_search_query()
                );
		    ?>
			</h1>

		<?php else : ?>

			<h1 class="page-title"><?php esc_html_e('Nessun risultato trovato', 'prolocosona'); ?></h1>

		<?php endif; ?>
	</header><!-- .page-header -->

	<figure class="max-w-content mx-auto mt-5 lg:mt-10">
		<img src="https://http.garden/404.jpg" class="w-full rounded-3xl" alt="404">
	</figure>

<!-- .page-content -->

</section>
