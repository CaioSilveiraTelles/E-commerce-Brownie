<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0.10
 */

// Footer sidebar
$chocorocco_footer_name = chocorocco_get_theme_option('footer_widgets');
$chocorocco_footer_present = !chocorocco_is_off($chocorocco_footer_name) && is_active_sidebar($chocorocco_footer_name);
if ($chocorocco_footer_present) { 
	chocorocco_storage_set('current_sidebar', 'footer');
	$chocorocco_footer_wide = chocorocco_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($chocorocco_footer_name) ) {
		dynamic_sidebar($chocorocco_footer_name);
	}
	$chocorocco_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($chocorocco_out)) {
		$chocorocco_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $chocorocco_out);
		$chocorocco_need_columns = true;	//or check: strpos($chocorocco_out, 'columns_wrap')===false;
		if ($chocorocco_need_columns) {
			$chocorocco_columns = max(0, (int) chocorocco_get_theme_option('footer_columns'));
			if ($chocorocco_columns == 0) $chocorocco_columns = min(4, max(1, substr_count($chocorocco_out, '<aside ')));
			if ($chocorocco_columns > 1)
				$chocorocco_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($chocorocco_columns).' widget ', $chocorocco_out);
			else
				$chocorocco_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($chocorocco_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$chocorocco_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($chocorocco_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'chocorocco_action_before_sidebar' );
				chocorocco_show_layout($chocorocco_out);
				do_action( 'chocorocco_action_after_sidebar' );
				if ($chocorocco_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$chocorocco_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>