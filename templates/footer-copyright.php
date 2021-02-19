<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0.10
 */

// Copyright area
$chocorocco_footer_scheme =  chocorocco_is_inherit(chocorocco_get_theme_option('footer_scheme')) ? chocorocco_get_theme_option('color_scheme') : chocorocco_get_theme_option('footer_scheme');
$chocorocco_copyright_scheme = chocorocco_is_inherit(chocorocco_get_theme_option('copyright_scheme')) ? $chocorocco_footer_scheme : chocorocco_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($chocorocco_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and [[...]] on the <i>...</i> and <b>...</b>
				$chocorocco_copyright = chocorocco_prepare_macros(chocorocco_get_theme_option('copyright'));
				if (!empty($chocorocco_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $chocorocco_copyright, $chocorocco_matches)) {
						$chocorocco_copyright = str_replace($chocorocco_matches[1], date(str_replace(array('{', '}'), '', $chocorocco_matches[1])), $chocorocco_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($chocorocco_copyright));
				}
			?></div>
		</div>
	</div>
</div>
