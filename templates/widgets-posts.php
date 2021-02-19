<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

$chocorocco_post_id    = get_the_ID();
$chocorocco_post_date  = chocorocco_get_date();
$chocorocco_post_title = get_the_title();
$chocorocco_post_link  = get_permalink();
$chocorocco_post_author_id   = get_the_author_meta('ID');
$chocorocco_post_author_name = get_the_author_meta('display_name');
$chocorocco_post_author_url  = get_author_posts_url($chocorocco_post_author_id, '');

$chocorocco_args = get_query_var('chocorocco_args_widgets_posts');
$chocorocco_show_date = isset($chocorocco_args['show_date']) ? (int) $chocorocco_args['show_date'] : 1;
$chocorocco_show_image = isset($chocorocco_args['show_image']) ? (int) $chocorocco_args['show_image'] : 1;
$chocorocco_show_author = isset($chocorocco_args['show_author']) ? (int) $chocorocco_args['show_author'] : 1;
$chocorocco_show_counters = isset($chocorocco_args['show_counters']) ? (int) $chocorocco_args['show_counters'] : 1;
$chocorocco_show_categories = isset($chocorocco_args['show_categories']) ? (int) $chocorocco_args['show_categories'] : 1;

$chocorocco_output = chocorocco_storage_get('chocorocco_output_widgets_posts');

$chocorocco_post_counters_output = '';
if ( $chocorocco_show_counters ) {
	$chocorocco_post_counters_output = '<span class="post_info_item post_info_counters">'
								. chocorocco_get_post_counters('comments')
							. '</span>';
}


$chocorocco_output .= '<article class="post_item with_thumb">';

if ($chocorocco_show_image) {
	$chocorocco_post_thumb = get_the_post_thumbnail($chocorocco_post_id, chocorocco_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($chocorocco_post_thumb) $chocorocco_output .= '<div class="post_thumb">' . ($chocorocco_post_link ? '<a href="' . esc_url($chocorocco_post_link) . '">' : '') . ($chocorocco_post_thumb) . ($chocorocco_post_link ? '</a>' : '') . '</div>';
}

$chocorocco_output .= '<div class="post_content">'
			. ($chocorocco_show_categories 
					? '<div class="post_categories">'
						. chocorocco_get_post_categories()
						. $chocorocco_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($chocorocco_post_link ? '<a href="' . esc_url($chocorocco_post_link) . '">' : '') . ($chocorocco_post_title) . ($chocorocco_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('chocorocco_filter_get_post_info', 
								'<div class="post_info">'
									. ($chocorocco_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($chocorocco_post_link ? '<a href="' . esc_url($chocorocco_post_link) . '" class="post_info_date">' : '') 
											. esc_html($chocorocco_post_date) 
											. ($chocorocco_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($chocorocco_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'chocorocco') . ' ' 
											. ($chocorocco_post_link ? '<a href="' . esc_url($chocorocco_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($chocorocco_post_author_name) 
											. ($chocorocco_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$chocorocco_show_categories && $chocorocco_post_counters_output
										? $chocorocco_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
chocorocco_storage_set('chocorocco_output_widgets_posts', $chocorocco_output);
?>