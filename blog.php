<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the Visual Composer to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$chocorocco_content = '';
$chocorocco_blog_archive_mask = '%%CONTENT%%';
$chocorocco_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $chocorocco_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($chocorocco_content = apply_filters('the_content', get_the_content())) != '') {
		if (($chocorocco_pos = strpos($chocorocco_content, $chocorocco_blog_archive_mask)) !== false) {
			$chocorocco_content = preg_replace('/(\<p\>\s*)?'.$chocorocco_blog_archive_mask.'(\s*\<\/p\>)/i', $chocorocco_blog_archive_subst, $chocorocco_content);
		} else
			$chocorocco_content .= $chocorocco_blog_archive_subst;
		$chocorocco_content = explode($chocorocco_blog_archive_mask, $chocorocco_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) chocorocco_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$chocorocco_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$chocorocco_args = chocorocco_query_add_posts_and_cats($chocorocco_args, '', chocorocco_get_theme_option('post_type'), chocorocco_get_theme_option('parent_cat'));
$chocorocco_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($chocorocco_page_number > 1) {
	$chocorocco_args['paged'] = $chocorocco_page_number;
	$chocorocco_args['ignore_sticky_posts'] = true;
}
$chocorocco_ppp = chocorocco_get_theme_option('posts_per_page');
if ((int) $chocorocco_ppp != 0)
	$chocorocco_args['posts_per_page'] = (int) $chocorocco_ppp;
// Make a new query
query_posts( $chocorocco_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($chocorocco_content) && count($chocorocco_content) == 2) {
	set_query_var('blog_archive_start', $chocorocco_content[0]);
	set_query_var('blog_archive_end', $chocorocco_content[1]);
}

get_template_part('index');
?>