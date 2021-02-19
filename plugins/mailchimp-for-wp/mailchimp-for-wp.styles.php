<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('chocorocco_mailchimp_get_css')) {
	add_filter('chocorocco_filter_get_css', 'chocorocco_mailchimp_get_css', 10, 4);
	function chocorocco_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		
			
			$rad = chocorocco_get_border_radius();
			$css['fonts'] .= <<<CSS

.mc4wp-form .mc4wp-form-fields input[type="email"],
.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}

CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

.mc4wp-form input[type="email"] {
	background-color: {$colors['bg_color_0']};
	border-color: {$colors['text']};
	color: {$colors['text']};
}
.mc4wp-form input[type="email"]:hover,
.mc4wp-form input[type="email"]:focus {
    border-color: {$colors['text_light']} !important;
}
.mc4wp-form input[type="email"]::-webkit-input-placeholder {
	color: {$colors['text']};
}
.mc4wp-form .mc4wp-alert {
	background-color: {$colors['text_link']};
	border-color: {$colors['text_hover']};
	color: {$colors['inverse_text']};
}
.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	background-color: {$colors['bg_color_0']};
	border-color: {$colors['text']};
	color: {$colors['text']};
}
.mc4wp-form .mc4wp-form-fields input[type="submit"]:focus,
.mc4wp-form .mc4wp-form-fields input[type="submit"]:hover {
	background-color: {$colors['text_light']};
	border-color: {$colors['text_light']} !important;
	color: {$colors['alter_dark']};
}
CSS;
		}

		return $css;
	}
}
?>