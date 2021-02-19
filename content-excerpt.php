<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

$chocorocco_post_format = get_post_format();
$chocorocco_post_format = empty($chocorocco_post_format) ? 'standard' : str_replace('post-format-', '', $chocorocco_post_format);
$chocorocco_animation = chocorocco_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($chocorocco_post_format) ); ?>
	<?php echo (!chocorocco_is_off($chocorocco_animation) ? ' data-animation="'.esc_attr(chocorocco_get_animation_classes($chocorocco_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	chocorocco_show_post_featured(array( 'thumb_size' => chocorocco_get_thumb_size( strpos(chocorocco_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));

	// Title and post meta
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('chocorocco_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

			do_action('chocorocco_action_before_post_meta'); 

			// Post meta
			$chocorocco_components = chocorocco_is_inherit(chocorocco_get_theme_option_from_meta('meta_parts')) 
										? 'date,author,counters,categories'
										: chocorocco_array_get_keys_by_value(chocorocco_get_theme_option('meta_parts'));
			$chocorocco_counters = chocorocco_is_inherit(chocorocco_get_theme_option_from_meta('counters')) 
										? 'comments'
										: chocorocco_array_get_keys_by_value(chocorocco_get_theme_option('counters'));

			if (!empty($chocorocco_components))
				chocorocco_show_post_meta(apply_filters('chocorocco_filter_post_meta_args', array(
					'components' => $chocorocco_components,
					'counters' => $chocorocco_counters,
					'seo' => false
					), 'excerpt', 1)
				);
			?>
		</div><!-- .post_header --><?php
	}
	
	// Post content
	?><div class="post_content entry-content"><?php
		if (chocorocco_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'chocorocco' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'chocorocco' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$chocorocco_show_learn_more = !in_array($chocorocco_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($chocorocco_post_format, array('link', 'aside', 'status'))) {
					the_content();
				} else if ($chocorocco_post_format == 'quote') {
					if (($quote = chocorocco_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
						chocorocco_show_layout(wpautop($quote));
					else
						the_excerpt();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
			?></div><?php
			// More button
			if ( $chocorocco_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'chocorocco'); ?></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
</article>