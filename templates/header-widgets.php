<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

// Header sidebar
$chocorocco_header_name = chocorocco_get_theme_option('header_widgets');
$chocorocco_header_present = !chocorocco_is_off($chocorocco_header_name) && is_active_sidebar($chocorocco_header_name);
if ($chocorocco_header_present) { 
	chocorocco_storage_set('current_sidebar', 'header');
	$chocorocco_header_wide = chocorocco_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($chocorocco_header_name) ) {
		dynamic_sidebar($chocorocco_header_name);
	}
	$chocorocco_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($chocorocco_widgets_output)) {
		$chocorocco_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $chocorocco_widgets_output);
		$chocorocco_need_columns = strpos($chocorocco_widgets_output, 'columns_wrap')===false;
		if ($chocorocco_need_columns) {
			$chocorocco_columns = max(0, (int) chocorocco_get_theme_option('header_columns'));
			if ($chocorocco_columns == 0) $chocorocco_columns = min(6, max(1, substr_count($chocorocco_widgets_output, '<aside ')));
			if ($chocorocco_columns > 1)
				$chocorocco_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($chocorocco_columns).' widget ', $chocorocco_widgets_output);
			else
				$chocorocco_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($chocorocco_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$chocorocco_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($chocorocco_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'chocorocco_action_before_sidebar' );
				chocorocco_show_layout($chocorocco_widgets_output);
				do_action( 'chocorocco_action_after_sidebar' );
				if ($chocorocco_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$chocorocco_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>