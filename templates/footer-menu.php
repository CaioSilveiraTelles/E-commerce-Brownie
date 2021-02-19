<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0.10
 */

// Footer menu
$chocorocco_menu_footer = chocorocco_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($chocorocco_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php chocorocco_show_layout($chocorocco_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>