<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0.10
 */

// Logo
if (chocorocco_is_on(chocorocco_get_theme_option('logo_in_footer'))) {
	$chocorocco_logo_image = '';
	if (chocorocco_get_retina_multiplier(2) > 1)
		$chocorocco_logo_image = chocorocco_get_theme_option( 'logo_footer_retina' );
	if (empty($chocorocco_logo_image)) 
		$chocorocco_logo_image = chocorocco_get_theme_option( 'logo_footer' );
	$chocorocco_logo_text   = get_bloginfo( 'name' );
	if (!empty($chocorocco_logo_image) || !empty($chocorocco_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($chocorocco_logo_image)) {
					$chocorocco_attr = chocorocco_getimagesize($chocorocco_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($chocorocco_logo_image).'" class="logo_footer_image" alt="'.esc_html(basename($chocorocco_logo_image)).'"'.(!empty($chocorocco_attr[3]) ? sprintf(' %s', $chocorocco_attr[3]) : '').'></a>' ;
				} else if (!empty($chocorocco_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($chocorocco_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>