<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some functionality here could be replaced by core features.
 *
 * @package prolocosona
 */
if (!function_exists('prolocosona_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     *
     * @param mixed $prefix
     */
    function prolocosona_posted_on($prefix = false)
    {
        $time_string = '<div class="published-container"><span class="' . (!$prefix ? 'sr-only' : '') . '">%1$s</span> <time class="published-datetime" datetime="%2$s">%3$s</time></div>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string .= '<div class="updated-container"><span class="' . (!$prefix ? 'sr-only' : '') . '">%4$s</span> <time class="updated-datetime" datetime="%5$s">%6$s</time></div>';
        }

        $time_string = sprintf(
            $time_string,
            esc_html__('Pubblicato il', 'prolocosona'),
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_html__('Ultima modifica il', 'prolocosona'),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        printf(
            '<a href="%1$s" rel="bookmark" class="datetimes">%2$s</a>',
            esc_url(get_permalink()),
            $time_string // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        );
    }
endif;

if (!function_exists('prolocosona_posted_by')) :
    /**
     * Prints HTML with meta information about theme author.
     */
    function prolocosona_posted_by()
    {
        printf(
            /* translators: 1: posted by label, only visible to screen readers. 2: author link. 3: post author. */
            '<div><span>%1$s</span><strong class="author vcard"><a class="url fn n text-primary" href="%2$s">%3$s</a></strong></div>',
            esc_html__('Autore: ', 'prolocosona'),
            esc_url(get_author_posts_url(get_the_author_meta('ID'))),
            esc_html(get_the_author())
        );
    }
endif;

if (!function_exists('prolocosona_entry_meta')) :
    /**
     * Prints HTML with meta information for the categories, and tags.
     * This template tag is used in the entry header.
     */
    function prolocosona_entry_meta()
    {
        // Hide author, post date, category and tag text for pages.
        if ('post' === get_post_type()) {
            // Posted on.
            prolocosona_posted_on();

            /* translators: used between list items, there is a space after the comma. */
            $categories_list = get_the_category_list(__('</li><li class="category-pill">', 'prolocosona'));
            if ($categories_list) {
                printf(
                    /* translators: 1: posted in label, only visible to screen readers. 2: list of categories. */
                    '<div class="categories"><span class="sr-only">%1$s</span><ul><li class="category-pill">%2$s</ul></div>',
                    esc_html__('Categorie: ', 'prolocosona'),
                    $categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                );
            }
        }
    }
endif;

if (!function_exists('prolocosona_entry_excerpt')) :
    /**
     * Prints HTML with meta information for the excertp.
     */
    function prolocosona_entry_excerpt()
    {
        if(get_the_excerpt()) {
            printf('<p class="excerpt">%1$s</p>', get_the_excerpt());
        }
    }
endif;

if (!function_exists('prolocosona_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, and tags.
     */
    function prolocosona_entry_footer()
    {
        // Hide author, post date, category and tag text for pages.
        if ('post' === get_post_type()) {
            // Posted by.
            prolocosona_posted_by();

            // Posted on.
            prolocosona_posted_on(true);

            $tags_list = get_the_tag_list('', __('</li><li class="tag-pill">', 'prolocosona'));
            if ($tags_list) {
                printf(
                    /* translators: 1: posted in label, only visible to screen readers. 2: list of tags. */
                    '<div class="tags"><span class="sr-only">%1$s</span><ul><li class="tag-pill">%2$s</ul></div>',
                    esc_html__('Tag: ', 'prolocosona'),
                    $tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                );
            }
        }
    }
endif;

if (!function_exists('prolocosona_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail, wrapping the post thumbnail in an
     * anchor element except when viewing a single post.
     */
    function prolocosona_post_thumbnail()
    {
        if (!prolocosona_can_show_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>

			<figure>
				<?php the_post_thumbnail(); ?>
			</figure><!-- .post-thumbnail -->

			<?php
        else :
            ?>

			<figure>
				<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail(); ?>
				</a>
			</figure>

			<?php
        endif; // End is_singular().
    }
endif;

if (!function_exists('prolocosona_the_posts_navigation')) :
    /**
     * Wraps `the_posts_pagination` for use throughout the theme.
     */
    function prolocosona_the_posts_navigation()
    {
        the_posts_pagination(
            [
                'mid_size'  => 2,
                'prev_text' => __('«', 'prolocosona'),
                'next_text' => __('»', 'prolocosona'),
            ]
        );
    }
endif;

if (!function_exists('prolocosona_content_class')) :
    /**
     * Displays the class names for the post content wrapper.
     *
     * This allows us to add Tailwind Typography’s modifier classes throughout
     * the theme without repeating them in multiple files. (They can be edited
     * at the top of the `../functions.php` file via the
     * PROLOCOSONA_TYPOGRAPHY_CLASSES constant.)
     *
     * Based on WordPress core’s `body_class` and `get_body_class` functions.
     *
     * @param string|string[] $classes space-separated string or array of class
     *                                 names to add to the class list
     */
    function prolocosona_content_class($classes = '')
    {
        $all_classes = [$classes, PROLOCOSONA_TYPOGRAPHY_CLASSES];

        foreach ($all_classes as &$class_groups) {
            if (!empty($class_groups)) {
                if (!is_array($class_groups)) {
                    $class_groups = preg_split('#\s+#', $class_groups);
                }
            } else {
                // Ensure that we always coerce class to being an array.
                $class_groups = [];
            }
        }

        $combined_classes = array_merge($all_classes[0], $all_classes[1]);
        $combined_classes = array_map('esc_attr', $combined_classes);

        // Separates class names with a single space, preparing them for the
        // post content wrapper.
        echo 'class="' . esc_attr(implode(' ', $combined_classes)) . '"';
    }
endif;
