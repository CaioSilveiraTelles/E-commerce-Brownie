<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

get_header();

while ( have_posts() ) { the_post();

	get_template_part( 'content', get_post_format() );


	// Related posts
	$chocorocco_related_posts = (int) chocorocco_get_theme_option('related_posts');
	if ($chocorocco_related_posts > 0) {
		chocorocco_show_related_posts(array('orderby' => 'rand',
										'posts_per_page' => max(1, min(9, chocorocco_get_theme_option('related_posts'))),
										'columns' => max(1, min(4, chocorocco_get_theme_option('related_columns')))
										),
									chocorocco_get_theme_option('related_style')
									);
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();
?>