<?php
/**
 * Functions which enhance the theme by hooking into WordPress.
 *
 * @package prolocosona
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function prolocosona_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'prolocosona_pingback_header');

/**
 * Get the page by template.
 *
 * @param mixed $template
 *
 * @return bool|WP_Post[]
 */
function get_page_by_template($template = '')
{
    $args = [
        'meta_key' => '_wp_page_template',
        'meta_value' => $template
    ];

    return get_pages($args);
}

/**
 * Filters the default archive titles.
 */
function prolocosona_get_the_archive_title()
{
    if (is_category()) {
        $title = __('', 'prolocosona') . '<span>' . single_term_title('', false) . '</span>';
    } elseif (is_tag()) {
        $title = __('Tag: ', 'prolocosona') . '<span>' . single_term_title('', false) . '</span>';
    } elseif (is_author()) {
        $title = __('Articoli di: ', 'prolocosona') . '<span>' . get_the_author_meta('display_name') . '</span>';
    } elseif (is_year()) {
        $title = __('Archivio dell\'anno: ', 'prolocosona') . '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'prolocosona')) . '</span>';
    } elseif (is_month()) {
        $title = __('Archivio del mese: ', 'prolocosona') . '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'prolocosona')) . '</span>';
    } elseif (is_day()) {
        $title = __('Archivio del giorno: ', 'prolocosona') . '<span>' . get_the_date() . '</span>';
    } elseif (is_post_type_archive()) {
        $cpt   = get_post_type_object(get_queried_object()->name);
        $title = sprintf(
            /* translators: %s: Post type singular name */
            esc_html__('%s Archives', 'prolocosona'),
            $cpt->labels->singular_name
        );
    } elseif (is_tax()) {
        $tax   = get_taxonomy(get_queried_object()->taxonomy);
        $title = sprintf(
            /* translators: %s: Taxonomy singular name */
            esc_html__('%s Archives', 'prolocosona'),
            $tax->labels->singular_name
        );
    } else {
        $title = __('Archives:', 'prolocosona');
    }

    return $title;
}
add_filter('get_the_archive_title', 'prolocosona_get_the_archive_title');

/**
 * Determines whether the post thumbnail can be displayed.
 */
function prolocosona_can_show_post_thumbnail()
{
    return apply_filters('prolocosona_can_show_post_thumbnail', !post_password_required() && !is_attachment() && has_post_thumbnail());
}

/**
 * Create the continue reading link.
 *
 * @param string $more_string the string shown within the more link
 */
function prolocosona_continue_reading_link($more_string)
{
    if (!is_admin()) {
        $continue_reading = sprintf(
            /* translators: %s: Name of current post. */
            wp_kses(__('Leggi tutto %s', 'prolocosona'), ['span' => ['class' => []]]),
            the_title('<span class="sr-only">"', '"</span>', false)
        );

        $more_string = '<a class="px-3 read-all" href="' . esc_url(get_permalink()) . '#testo-completo">' . $continue_reading . '</a>';
    }

    return $more_string;
}

// Filter the excerpt more link.
add_filter('excerpt_more', 'prolocosona_continue_reading_link');

// Filter the content more link.
add_filter('the_content_more_link', 'prolocosona_continue_reading_link');
