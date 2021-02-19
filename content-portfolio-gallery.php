<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

$chocorocco_blog_style = explode('_', chocorocco_get_theme_option('blog_style'));
$chocorocco_columns = empty($chocorocco_blog_style[1]) ? 2 : max(2, $chocorocco_blog_style[1]);
$chocorocco_post_format = get_post_format();
$chocorocco_post_format = empty($chocorocco_post_format) ? 'standard' : str_replace('post-format-', '', $chocorocco_post_format);
$chocorocco_animation = chocorocco_get_theme_option('blog_animation');
$chocorocco_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($chocorocco_columns).' post_format_'.esc_attr($chocorocco_post_format) ); ?>
	<?php echo (!chocorocco_is_off($chocorocco_animation) ? ' data-animation="'.esc_attr(chocorocco_get_animation_classes($chocorocco_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($chocorocco_image[1]) && !empty($chocorocco_image[2])) echo intval($chocorocco_image[1]) .'x' . intval($chocorocco_image[2]); ?>"
	data-src="<?php if (!empty($chocorocco_image[0])) echo esc_url($chocorocco_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$chocorocco_image_hover = 'icon';	//chocorocco_get_theme_option('image_hover');
	if (in_array($chocorocco_image_hover, array('icons', 'zoom'))) $chocorocco_image_hover = 'dots';
	$chocorocco_components = chocorocco_is_inherit(chocorocco_get_theme_option_from_meta('meta_parts')) 
								? 'categories,date,counters,share'
								: chocorocco_array_get_keys_by_value(chocorocco_get_theme_option('meta_parts'));
	$chocorocco_counters = chocorocco_is_inherit(chocorocco_get_theme_option_from_meta('counters')) 
								? 'comments'
								: chocorocco_array_get_keys_by_value(chocorocco_get_theme_option('counters'));
	chocorocco_show_post_featured(array(
		'hover' => $chocorocco_image_hover,
		'thumb_size' => chocorocco_get_thumb_size( strpos(chocorocco_get_theme_option('body_style'), 'full')!==false || $chocorocco_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($chocorocco_components)
										? chocorocco_show_post_meta(apply_filters('chocorocco_filter_post_meta_args', array(
											'components' => $chocorocco_components,
											'counters' => $chocorocco_counters,
											'seo' => false,
											'echo' => false
											), $chocorocco_blog_style[0], $chocorocco_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'chocorocco') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>