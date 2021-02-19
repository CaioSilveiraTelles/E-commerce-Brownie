<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

chocorocco_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'masonry' );
wp_enqueue_script( 'classie', chocorocco_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'chocorocco-gallery-script', chocorocco_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$chocorocco_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$chocorocco_sticky_out = chocorocco_get_theme_option('sticky_style')=='columns' 
							&& is_array($chocorocco_stickies) && count($chocorocco_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$chocorocco_cat = chocorocco_get_theme_option('parent_cat');
	$chocorocco_post_type = chocorocco_get_theme_option('post_type');
	$chocorocco_taxonomy = chocorocco_get_post_type_taxonomy($chocorocco_post_type);
	$chocorocco_show_filters = chocorocco_get_theme_option('show_filters');
	$chocorocco_tabs = array();
	if (!chocorocco_is_off($chocorocco_show_filters)) {
		$chocorocco_args = array(
			'type'			=> $chocorocco_post_type,
			'child_of'		=> $chocorocco_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $chocorocco_taxonomy,
			'pad_counts'	=> false
		);
		$chocorocco_portfolio_list = get_terms($chocorocco_args);
		if (is_array($chocorocco_portfolio_list) && count($chocorocco_portfolio_list) > 0) {
			$chocorocco_tabs[$chocorocco_cat] = esc_html__('All', 'chocorocco');
			foreach ($chocorocco_portfolio_list as $chocorocco_term) {
				if (isset($chocorocco_term->term_id)) $chocorocco_tabs[$chocorocco_term->term_id] = $chocorocco_term->name;
			}
		}
	}
	if (count($chocorocco_tabs) > 0) {
		$chocorocco_portfolio_filters_ajax = true;
		$chocorocco_portfolio_filters_active = $chocorocco_cat;
		$chocorocco_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters chocorocco_tabs chocorocco_tabs_ajax">
			<ul class="portfolio_titles chocorocco_tabs_titles">
				<?php
				foreach ($chocorocco_tabs as $chocorocco_id=>$chocorocco_title) {
					?><li><a href="<?php echo esc_url(chocorocco_get_hash_link(sprintf('#%s_%s_content', $chocorocco_portfolio_filters_id, $chocorocco_id))); ?>" data-tab="<?php echo esc_attr($chocorocco_id); ?>"><?php echo esc_html($chocorocco_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$chocorocco_ppp = chocorocco_get_theme_option('posts_per_page');
			if (chocorocco_is_inherit($chocorocco_ppp)) $chocorocco_ppp = '';
			foreach ($chocorocco_tabs as $chocorocco_id=>$chocorocco_title) {
				$chocorocco_portfolio_need_content = $chocorocco_id==$chocorocco_portfolio_filters_active || !$chocorocco_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $chocorocco_portfolio_filters_id, $chocorocco_id)); ?>"
					class="portfolio_content chocorocco_tabs_content"
					data-blog-template="<?php echo esc_attr(chocorocco_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(chocorocco_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($chocorocco_ppp); ?>"
					data-post-type="<?php echo esc_attr($chocorocco_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($chocorocco_taxonomy); ?>"
					data-cat="<?php echo esc_attr($chocorocco_id); ?>"
					data-parent-cat="<?php echo esc_attr($chocorocco_cat); ?>"
					data-need-content="<?php echo (false===$chocorocco_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($chocorocco_portfolio_need_content) 
						chocorocco_show_portfolio_posts(array(
							'cat' => $chocorocco_id,
							'parent_cat' => $chocorocco_cat,
							'taxonomy' => $chocorocco_taxonomy,
							'post_type' => $chocorocco_post_type,
							'page' => 1,
							'sticky' => $chocorocco_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		chocorocco_show_portfolio_posts(array(
			'cat' => $chocorocco_cat,
			'parent_cat' => $chocorocco_cat,
			'taxonomy' => $chocorocco_taxonomy,
			'post_type' => $chocorocco_post_type,
			'page' => 1,
			'sticky' => $chocorocco_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>