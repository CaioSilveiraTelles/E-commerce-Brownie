<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($chocorocco_columns).' post_format_'.esc_attr($chocorocco_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!chocorocco_is_off($chocorocco_animation) ? ' data-animation="'.esc_attr(chocorocco_get_animation_classes($chocorocco_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$chocorocco_image_hover = chocorocco_get_theme_option('image_hover');
	// Featured image
	chocorocco_show_post_featured(array(
		'thumb_size' => chocorocco_get_thumb_size(strpos(chocorocco_get_theme_option('body_style'), 'full')!==false || $chocorocco_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $chocorocco_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $chocorocco_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>