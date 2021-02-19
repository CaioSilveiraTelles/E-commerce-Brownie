<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

$chocorocco_link = get_permalink();
$chocorocco_post_format = get_post_format();
$chocorocco_post_format = empty($chocorocco_post_format) ? 'standard' : str_replace('post-format-', '', $chocorocco_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_1 post_format_'.esc_attr($chocorocco_post_format) ); ?>><?php
	chocorocco_show_post_featured(array(
		'thumb_size' => chocorocco_get_thumb_size( (int) chocorocco_get_theme_option('related_posts') == 1 ? 'huge' : 'big' ),
		'show_no_image' => false,
		'singular' => false,
		'post_info' => '<div class="post_header entry-header">'
							. '<div class="post_categories">' . chocorocco_get_post_categories('') . '</div>'
							. '<h6 class="post_title entry-title"><a href="' . esc_url($chocorocco_link) . '">' . get_the_title() . '</a></h6>'
							. (in_array(get_post_type(), array('post', 'attachment'))
									? '<span class="post_date"><a href="' . esc_url($chocorocco_link) . '">' . chocorocco_get_date() . '</a></span>'
									: '')
						. '</div>'
		)
	);
?></div>