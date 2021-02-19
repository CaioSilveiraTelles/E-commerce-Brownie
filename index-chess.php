<?php
/**
 * The template for homepage posts with "Chess" style
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

chocorocco_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$chocorocco_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$chocorocco_sticky_out = chocorocco_get_theme_option('sticky_style')=='columns' 
							&& is_array($chocorocco_stickies) && count($chocorocco_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($chocorocco_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$chocorocco_sticky_out) {
		?><div class="chess_wrap posts_container"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($chocorocco_sticky_out && !is_sticky()) {
			$chocorocco_sticky_out = false;
			?></div><div class="chess_wrap posts_container"><?php
		}
		get_template_part( 'content', $chocorocco_sticky_out && is_sticky() ? 'sticky' :'chess' );
	}
	
	?></div><?php

	chocorocco_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>