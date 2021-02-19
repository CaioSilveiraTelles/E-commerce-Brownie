<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

$chocorocco_header_css = $chocorocco_header_image = '';
$chocorocco_header_video = chocorocco_get_header_video();
if (true || empty($chocorocco_header_video)) {
	$chocorocco_header_image = get_header_image();
	if (chocorocco_is_on(chocorocco_get_theme_option('header_image_override')) && apply_filters('chocorocco_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($chocorocco_cat_img = chocorocco_get_category_image()) != '')
				$chocorocco_header_image = $chocorocco_cat_img;
		} else if (is_singular() || chocorocco_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$chocorocco_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($chocorocco_header_image)) $chocorocco_header_image = $chocorocco_header_image[0];
			} else
				$chocorocco_header_image = '';
		}
	}
}

?><header class="top_panel top_panel_default<?php
					echo !empty($chocorocco_header_image) || !empty($chocorocco_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($chocorocco_header_video!='') echo ' with_bg_video';
					if ($chocorocco_header_image!='') echo ' '.esc_attr(chocorocco_add_inline_css_class('background-image: url('.esc_url($chocorocco_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (chocorocco_is_on(chocorocco_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
					?> scheme_<?php echo esc_attr(chocorocco_is_inherit(chocorocco_get_theme_option('header_scheme')) 
													? chocorocco_get_theme_option('color_scheme') 
													: chocorocco_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($chocorocco_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (chocorocco_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Header for single posts
	get_template_part( 'templates/header-single' );

?></header>