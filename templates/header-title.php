<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

// Page (category, tag, archive, author) title

if ( chocorocco_need_page_title() ) {
	chocorocco_sc_layouts_showed('title', true);
	chocorocco_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php

						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$chocorocco_blog_title = chocorocco_get_blog_title();
							$chocorocco_blog_title_text = $chocorocco_blog_title_class = $chocorocco_blog_title_link = $chocorocco_blog_title_link_text = '';
							if (is_array($chocorocco_blog_title)) {
								$chocorocco_blog_title_text = $chocorocco_blog_title['text'];
								$chocorocco_blog_title_class = !empty($chocorocco_blog_title['class']) ? ' '.$chocorocco_blog_title['class'] : '';
								$chocorocco_blog_title_link = !empty($chocorocco_blog_title['link']) ? $chocorocco_blog_title['link'] : '';
								$chocorocco_blog_title_link_text = !empty($chocorocco_blog_title['link_text']) ? $chocorocco_blog_title['link_text'] : '';
							} else
								$chocorocco_blog_title_text = $chocorocco_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($chocorocco_blog_title_class); ?>"><?php
								$chocorocco_top_icon = chocorocco_get_category_icon();
								if (!empty($chocorocco_top_icon)) {
									$chocorocco_attr = chocorocco_getimagesize($chocorocco_top_icon);
									?><img src="<?php echo esc_url($chocorocco_top_icon); ?>" alt="<?php echo esc_html(basename($chocorocco_top_icon)); ?>" <?php if (!empty($chocorocco_attr[3])) chocorocco_show_layout($chocorocco_attr[3]);?>><?php
								}
								echo wp_kses_data($chocorocco_blog_title_text);
							?></h1>
							<?php
							if (!empty($chocorocco_blog_title_link) && !empty($chocorocco_blog_title_link_text)) {
								?><a href="<?php echo esc_url($chocorocco_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($chocorocco_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'chocorocco_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>