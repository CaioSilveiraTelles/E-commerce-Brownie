<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

$chocorocco_args = get_query_var('chocorocco_logo_args');

// Site logo
$chocorocco_logo_image  = chocorocco_get_logo_image(isset($chocorocco_args['type']) ? $chocorocco_args['type'] : '');
$chocorocco_logo_text   = chocorocco_is_on(chocorocco_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$chocorocco_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($chocorocco_logo_image) || !empty($chocorocco_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($chocorocco_logo_image)) {
			$chocorocco_attr = chocorocco_getimagesize($chocorocco_logo_image);
			echo '<img src="'.esc_url($chocorocco_logo_image).'" alt="'.esc_html(basename($chocorocco_logo_image)).'"'.(!empty($chocorocco_attr[3]) ? sprintf(' %s', $chocorocco_attr[3]) : '').'>' ;
		} else {
			chocorocco_show_layout(chocorocco_prepare_macros($chocorocco_logo_text), '<span class="logo_text">', '</span>');
			chocorocco_show_layout(chocorocco_prepare_macros($chocorocco_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>