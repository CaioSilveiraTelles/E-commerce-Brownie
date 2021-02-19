<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0.10
 */


// Socials
if ( chocorocco_is_on(chocorocco_get_theme_option('socials_in_footer')) && ($chocorocco_output = chocorocco_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php chocorocco_show_layout($chocorocco_output); ?>
		</div>
	</div>
	<?php
}
?>