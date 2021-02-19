<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0.10
 */

$chocorocco_footer_scheme =  chocorocco_is_inherit(chocorocco_get_theme_option('footer_scheme')) ? chocorocco_get_theme_option('color_scheme') : chocorocco_get_theme_option('footer_scheme');
$chocorocco_footer_id = str_replace('footer-custom-', '', chocorocco_get_theme_option("footer_style"));
$chocorocco_footer_meta = get_post_meta($chocorocco_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($chocorocco_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($chocorocco_footer_id))); 
						if (!empty($chocorocco_footer_meta['margin']) != '') 
							echo ' '.esc_attr(chocorocco_add_inline_css_class('margin-top: '.esc_attr(chocorocco_prepare_css_value($chocorocco_footer_meta['margin'])).';'));
						?> scheme_<?php echo esc_attr($chocorocco_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('chocorocco_action_show_layout', $chocorocco_footer_id);
	?>
</footer><!-- /.footer_wrap -->
