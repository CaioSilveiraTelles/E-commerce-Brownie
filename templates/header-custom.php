<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0.06
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

$chocorocco_header_id = str_replace('header-custom-', '', chocorocco_get_theme_option("header_style"));
$chocorocco_header_meta = get_post_meta($chocorocco_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($chocorocco_header_id); 
						?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($chocorocco_header_id)));
						echo !empty($chocorocco_header_image) || !empty($chocorocco_header_video) 
							? ' with_bg_image' 
							: ' without_bg_image';
						if ($chocorocco_header_video!='') 
							echo ' with_bg_video';
						if ($chocorocco_header_image!='') 
							echo ' '.esc_attr(chocorocco_add_inline_css_class('background-image: url('.esc_url($chocorocco_header_image).');'));
						if (!empty($chocorocco_header_meta['margin']) != '') 
							echo ' '.esc_attr(chocorocco_add_inline_css_class('margin-bottom: '.esc_attr(chocorocco_prepare_css_value($chocorocco_header_meta['margin'])).';'));
						if (is_single() && has_post_thumbnail()) 
							echo ' with_featured_image';
						if (chocorocco_is_on(chocorocco_get_theme_option('header_fullheight'))) 
							echo ' header_fullheight trx-stretch-height';
						?> scheme_<?php echo esc_attr(chocorocco_is_inherit(chocorocco_get_theme_option('header_scheme')) 
														? chocorocco_get_theme_option('color_scheme') 
														: chocorocco_get_theme_option('header_scheme'));
						?>"><?php

	// Background video
	if (!empty($chocorocco_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('chocorocco_action_show_layout', $chocorocco_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>