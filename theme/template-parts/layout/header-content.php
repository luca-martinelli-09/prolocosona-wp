<?php
/**
 * Template part for displaying the header content.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package prolocosona
 */
?>

<header id="masthead" class="w-full text-gray-700 bg-transparent z-50 py-3 px-3">
  <div x-data="{ open: false }" class="grid grid-cols-2 items-center max-w-wide mx-auto xl:grid-cols-3">
    <div class="flex flex-row items-center gap-3 order-1">
      <button class="xl:hidden rounded-lg" @click="open = !open" aria-controls="primary-menu" :aria-expanded="open">
        <span class="sr-only"><?php esc_html_e('Primary Menu', 'prolocosona'); ?></span>
        <svg fill="currentColor" viewBox="0 0 20 20" class="w-7 h-7">
          <path x-show="!open" fill-rule="evenodd" d="M17 5C17 4.73478 16.8946 4.48043 16.7071 4.29289C16.5196 4.10536 16.2652 4 16 4H4C3.73478 4 3.48043 4.10536 3.29289 4.29289C3.10536 4.48043 3 4.73478 3 5C3 5.26522 3.10536 5.51957 3.29289 5.70711C3.48043 5.89464 3.73478 6 4 6H16C16.2652 6 16.5196 5.89464 16.7071 5.70711C16.8946 5.51957 17 5.26522 17 5ZM17 10C17 9.73478 16.8946 9.48043 16.7071 9.29289C16.5196 9.10536 16.2652 9 16 9H4C3.73478 9 3.48043 9.10536 3.29289 9.29289C3.10536 9.48043 3 9.73478 3 10C3 10.2652 3.10536 10.5196 3.29289 10.7071C3.48043 10.8946 3.73478 11 4 11H16C16.2652 11 16.5196 10.8946 16.7071 10.7071C16.8946 10.5196 17 10.2652 17 10ZM11 15C11 14.7348 10.8946 14.4804 10.7071 14.2929C10.5196 14.1054 10.2652 14 10 14H4C3.73478 14 3.48043 14.1054 3.29289 14.2929C3.10536 14.4804 3 14.7348 3 15C3 15.2652 3.10536 15.5196 3.29289 15.7071C3.48043 15.8946 3.73478 16 4 16H10C10.2652 16 10.5196 15.8946 10.7071 15.7071C10.8946 15.5196 11 15.2652 11 15Z" clip-rule="evenodd"></path>
          <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
      		<?php
            $site_logo_id = get_theme_mod('custom_logo');
$site_logo = wp_get_attachment_image_src($site_logo_id, 'full');

if (has_custom_logo()) : ?>
                  <a href="<?php echo esc_url(home_url()); ?>"><img class="w-20 xl:w-28" src="<?php echo esc_url($site_logo[0]); ?>" alt="<?php echo esc_url(get_bloginfo('name')); ?>"></a>
                  <?php
elseif (is_front_page()) :
    ?>
                  <h1><?php bloginfo('name'); ?></h1>
                  <?php
else :
    ?>
                  <p><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                  <?php
endif;
?>
    </div>
		<nav :class="{'flex': open, 'hidden': !open}" class="hidden col-span-2 xl:items-center xl:col-span-1 order-3 xl:order-2 whitespace-nowrap xl:flex flex-col pt-5 xl:pt-0" id="site-navigation" aria-label="<?php esc_attr_e('Main Navigation', 'prolocosona'); ?>">
			<?php
    wp_nav_menu(
        [
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
            'menu_class' => 'flex-col flex-grow pb-4 xl:pb-0 flex xl:justify-end xl:flex-row gap-1 w-full',
            'li_atts' => [
                '@click.away' => 'open = false',
                ':class' => "{ 'opened': open }",
                'x-data' => '{ open: false }',
            ],
            'li_class' => 'flex no-wrap',
            'submenu_atts' => [
                'x-show' => 'open',
                ':class' => '{"hidden": !open, "block": open}',
                'x-transition:enter' => 'transition ease-out duration-100',
                'x-transition:enter-start' => 'transform opacity-0 scale-95',
                'x-transition:enter-end' => 'transform opacity-100 scale-100',
                'x-transition:leave' => 'transition ease-in duration-75',
                'x-transition:leave-start' => 'transform opacity-100 scale-100',
                'x-transition:leave-end' => 'transform opacity-0 scale-95'
            ],
            'dropdown_button' => "<button @click=\"open = !open\" class='dropdown-button-menu'><svg fill='currentColor' viewBox='0 0 20 20' class='w-4 transition-transform duration-200 transform'><path fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' clip-rule='evenodd'></path></svg></button>"
        ]
    );
?>
		</nav><!-- #site-navigation -->
        <?php
$contactPages = get_page_by_template('cta.php');
if (sizeof($contactPages) > 0 && $contactPage = $contactPages[0]) : ?>
<div class="flex items-center justify-end order-2 xl:order-3 wp-block-button">
  <a href="<?php echo get_permalink($contactPage); ?>" class="wp-element-button"><?php echo get_the_title($contactPage); ?></a>
</div>
    <?php
endif;
?>
  </div>
</header><!-- #masthead -->
