<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

$chocorocco_sidebar_position = chocorocco_get_theme_option('sidebar_position');
if (chocorocco_sidebar_present()) {
	ob_start();
	$chocorocco_sidebar_name = chocorocco_get_theme_option('sidebar_widgets');
	chocorocco_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($chocorocco_sidebar_name) ) {
		dynamic_sidebar($chocorocco_sidebar_name);
	}
	$chocorocco_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($chocorocco_out)) {
		?>
		<div class="sidebar <?php echo esc_attr($chocorocco_sidebar_position); ?> widget_area<?php if (!chocorocco_is_inherit(chocorocco_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(chocorocco_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'chocorocco_action_before_sidebar' );
				chocorocco_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $chocorocco_out));
				do_action( 'chocorocco_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>