<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

$chocorocco_blog_style = explode('_', chocorocco_get_theme_option('blog_style'));
$chocorocco_columns = empty($chocorocco_blog_style[1]) ? 2 : max(2, $chocorocco_blog_style[1]);
$chocorocco_expanded = !chocorocco_sidebar_present() && chocorocco_is_on(chocorocco_get_theme_option('expand_content'));
$chocorocco_post_format = get_post_format();
$chocorocco_post_format = empty($chocorocco_post_format) ? 'standard' : str_replace('post-format-', '', $chocorocco_post_format);
$chocorocco_animation = chocorocco_get_theme_option('blog_animation');
$chocorocco_components = chocorocco_is_inherit(chocorocco_get_theme_option_from_meta('meta_parts')) 
							? 'date,author'
							: chocorocco_array_get_keys_by_value(chocorocco_get_theme_option('meta_parts'));
$chocorocco_counters = chocorocco_is_inherit(chocorocco_get_theme_option_from_meta('counters')) 
							? 'comments'
							: chocorocco_array_get_keys_by_value(chocorocco_get_theme_option('counters'));

?><div class="<?php echo trim($chocorocco_blog_style[0]) == 'classic' ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($chocorocco_columns); ?>"><article id="post-<?php the_ID(); ?>"
	<?php post_class( 'post_item post_format_'.esc_attr($chocorocco_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($chocorocco_columns)
					. ' post_layout_'.esc_attr($chocorocco_blog_style[0]) 
					. ' post_layout_'.esc_attr($chocorocco_blog_style[0]).'_'.esc_attr($chocorocco_columns)
					); ?>
	<?php echo (!chocorocco_is_off($chocorocco_animation) ? ' data-animation="'.esc_attr(chocorocco_get_animation_classes($chocorocco_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	chocorocco_show_post_featured( array( 'thumb_size' => chocorocco_get_thumb_size($chocorocco_blog_style[0] == 'classic'
													? (strpos(chocorocco_get_theme_option('body_style'), 'full')!==false 
															? ( $chocorocco_columns > 2 ? 'big' : 'huge' )
															: (	$chocorocco_columns > 2
																? ($chocorocco_expanded ? 'med' : 'small')
																: ($chocorocco_expanded ? 'big' : 'med')
																)
														)
													: (strpos(chocorocco_get_theme_option('body_style'), 'full')!==false 
															? ( $chocorocco_columns > 2 ? 'masonry-big' : 'full' )
															: (	$chocorocco_columns <= 2 && $chocorocco_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($chocorocco_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('chocorocco_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('chocorocco_action_before_post_meta'); 

			// Post meta
			if (!empty($chocorocco_components))
				chocorocco_show_post_meta(apply_filters('chocorocco_filter_post_meta_args', array(
					'components' => $chocorocco_components,
					'counters' => $chocorocco_counters,
					'seo' => false
					), $chocorocco_blog_style[0], $chocorocco_columns)
				);

			do_action('chocorocco_action_after_post_meta'); 
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$chocorocco_show_learn_more = false; //!in_array($chocorocco_post_format, array('link', 'aside', 'status', 'quote'));
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
			?>
		</div>
		<?php
		// Post meta
		if (in_array($chocorocco_post_format, array('link', 'aside', 'status', 'quote'))) {
			if (!empty($chocorocco_components))
				chocorocco_show_post_meta(apply_filters('chocorocco_filter_post_meta_args', array(
					'components' => $chocorocco_components,
					'counters' => $chocorocco_counters
					), $chocorocco_blog_style[0], $chocorocco_columns)
				);
		}
		// More button
		if ( $chocorocco_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'chocorocco'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>