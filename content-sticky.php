<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

$chocorocco_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$chocorocco_post_format = get_post_format();
$chocorocco_post_format = empty($chocorocco_post_format) ? 'standard' : str_replace('post-format-', '', $chocorocco_post_format);
$chocorocco_animation = chocorocco_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($chocorocco_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($chocorocco_post_format) ); ?>
	<?php echo (!chocorocco_is_off($chocorocco_animation) ? ' data-animation="'.esc_attr(chocorocco_get_animation_classes($chocorocco_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	chocorocco_show_post_featured(array(
		'thumb_size' => chocorocco_get_thumb_size($chocorocco_columns==1 ? 'big' : ($chocorocco_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($chocorocco_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			chocorocco_show_post_meta(apply_filters('chocorocco_filter_post_meta_args', array(), 'sticky', $chocorocco_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>