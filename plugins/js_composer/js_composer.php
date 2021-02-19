<?php
/* Visual Composer support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('chocorocco_vc_theme_setup9')) {
	add_action( 'after_setup_theme', 'chocorocco_vc_theme_setup9', 9 );
	function chocorocco_vc_theme_setup9() {
		if (chocorocco_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 								'chocorocco_vc_frontend_scripts', 1100 );
			add_filter( 'chocorocco_filter_merge_styles',						'chocorocco_vc_merge_styles' );
	
			// Add/Remove params in the standard VC shortcodes
			//-----------------------------------------------------
			add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,					'chocorocco_vc_add_params_classes', 10, 3 );
			
			// Color scheme
			$scheme = array(
				"param_name" => "scheme",
				"heading" => esc_html__("Color scheme", 'chocorocco'),
				"description" => wp_kses_data( __("Select color scheme to decorate this block", 'chocorocco') ),
				"group" => esc_html__('Colors', 'chocorocco'),
				"admin_label" => true,
				"value" => array_flip(chocorocco_get_list_schemes(true)),
				"type" => "dropdown"
			);
			vc_add_param("vc_section", $scheme);
			vc_add_param("vc_row", $scheme);
			vc_add_param("vc_row_inner", $scheme);
			vc_add_param("vc_column", $scheme);
			vc_add_param("vc_column_inner", $scheme);
			vc_add_param("vc_column_text", $scheme);
			
			// Alter height and hide on mobile for Empty Space
			vc_add_param("vc_empty_space", array(
				"param_name" => "alter_height",
				"heading" => esc_html__("Alter height", 'chocorocco'),
				"description" => wp_kses_data( __("Select alternative height instead value from the field above", 'chocorocco') ),
				"admin_label" => true,
				"value" => array(
					esc_html__('Tiny', 'chocorocco') => 'tiny',
					esc_html__('Small', 'chocorocco') => 'small',
					esc_html__('Medium', 'chocorocco') => 'medium',
					esc_html__('Large', 'chocorocco') => 'large',
					esc_html__('Huge', 'chocorocco') => 'huge',
					esc_html__('From the value above', 'chocorocco') => 'none'
				),
				"type" => "dropdown"
			));
			vc_add_param("vc_empty_space", array(
				"param_name" => "hide_on_mobile",
				"heading" => esc_html__("Hide on mobile", 'chocorocco'),
				"description" => wp_kses_data( __("Hide this block on the mobile devices, when the columns are arranged one under another", 'chocorocco') ),
				"admin_label" => true,
				"std" => 0,
				"value" => array(
					esc_html__("Hide on mobile", 'chocorocco') => "1",
					esc_html__("Hide on tablet", 'chocorocco') => "3",
					esc_html__("Hide on notebook", 'chocorocco') => "2" 
					),
				"type" => "checkbox"
			));
			
			// Add Narrow style to the Progress bars
			vc_add_param("vc_progress_bar", array(
				"param_name" => "narrow",
				"heading" => esc_html__("Narrow", 'chocorocco'),
				"description" => wp_kses_data( __("Use narrow style for the progress bar", 'chocorocco') ),
				"std" => 0,
				"value" => array(esc_html__("Narrow style", 'chocorocco') => "1" ),
				"type" => "checkbox"
			));
			
			// Add param 'Closeable' to the Message Box
			vc_add_param("vc_message", array(
				"param_name" => "closeable",
				"heading" => esc_html__("Closeable", 'chocorocco'),
				"description" => wp_kses_data( __("Add 'Close' button to the message box", 'chocorocco') ),
				"std" => 0,
				"value" => array(esc_html__("Closeable", 'chocorocco') => "1" ),
				"type" => "checkbox"
			));
		}
		if (is_admin()) {
			add_filter( 'chocorocco_filter_tgmpa_required_plugins',		'chocorocco_vc_tgmpa_required_plugins' );
			add_filter( 'vc_iconpicker-type-fontawesome',				'chocorocco_vc_iconpicker_type_fontawesome' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'chocorocco_vc_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('chocorocco_filter_tgmpa_required_plugins',	'chocorocco_vc_tgmpa_required_plugins');
	function chocorocco_vc_tgmpa_required_plugins($list=array()) {
		if (in_array('js_composer', chocorocco_storage_get('required_plugins'))) {
			$path = chocorocco_get_file_dir('plugins/js_composer/js_composer.zip');
			$list[] = array(
					'name' 		=> esc_html__('Visual Composer', 'chocorocco'),
					'slug' 		=> 'js_composer',
					'source'	=> !empty($path) ? $path : 'upload://js_composer.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if Visual Composer installed and activated
if ( !function_exists( 'chocorocco_exists_visual_composer' ) ) {
	function chocorocco_exists_visual_composer() {
		return class_exists('Vc_Manager');
	}
}

// Check if Visual Composer in frontend editor mode
if ( !function_exists( 'chocorocco_vc_is_frontend' ) ) {
	function chocorocco_vc_is_frontend() {
		return (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true')
			|| (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline');
		//return function_exists('vc_is_frontend_editor') && vc_is_frontend_editor();
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'chocorocco_vc_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'chocorocco_vc_frontend_scripts', 1100 );
	function chocorocco_vc_frontend_scripts() {
		if (chocorocco_exists_visual_composer()) {
			if (chocorocco_is_on(chocorocco_get_theme_option('debug_mode')) && chocorocco_get_file_dir('plugins/js_composer/js_composer.css')!='')
				wp_enqueue_style( 'chocorocco-js_composer',  chocorocco_get_file_url('plugins/js_composer/js_composer.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'chocorocco_vc_merge_styles' ) ) {
	//Handler of the add_filter('chocorocco_filter_merge_styles', 'chocorocco_vc_merge_styles');
	function chocorocco_vc_merge_styles($list) {
		$list[] = 'plugins/js_composer/js_composer.css';
		return $list;
	}
}
	
// Add theme icons into VC iconpicker list
if ( !function_exists( 'chocorocco_vc_iconpicker_type_fontawesome' ) ) {
	//Handler of the add_filter( 'vc_iconpicker-type-fontawesome',	'chocorocco_vc_iconpicker_type_fontawesome' );
	function chocorocco_vc_iconpicker_type_fontawesome($icons) {
		$list = chocorocco_get_list_icons();
		if (!is_array($list) || count($list) == 0) return $icons;
		$rez = array();
		foreach ($list as $icon)
			$rez[] = array($icon => str_replace('icon-', '', $icon));
		return array_merge( $icons, array(esc_html__('Theme Icons', 'chocorocco') => $rez) );
	}
}



// Shortcodes
//------------------------------------------------------------------------

// Add params to the standard VC shortcodes
if ( !function_exists( 'chocorocco_vc_add_params_classes' ) ) {
	//Handler of the add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'chocorocco_vc_add_params_classes', 10, 3 );
	function chocorocco_vc_add_params_classes($classes, $sc, $atts) {
		if (in_array($sc, array('vc_section', 'vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner', 'vc_column_text'))) {
			if (!empty($atts['scheme']) && !chocorocco_is_inherit($atts['scheme']))
				$classes .= ($classes ? ' ' : '') . 'scheme_' . $atts['scheme'];
		} else if (in_array($sc, array('vc_empty_space'))) {
			if (!empty($atts['alter_height']) && !chocorocco_is_off($atts['alter_height']))
				$classes .= ($classes ? ' ' : '') . 'height_' . $atts['alter_height'];
			if (!empty($atts['hide_on_mobile'])) {
				if (strpos($atts['hide_on_mobile'], '1')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_mobile';
				if (strpos($atts['hide_on_mobile'], '2')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_notebook';
				if (strpos($atts['hide_on_mobile'], '3')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_tablet';
			}
		} else if (in_array($sc, array('vc_progress_bar'))) {
			if (!empty($atts['narrow']) && (int) $atts['narrow']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_progress_bar_narrow';
		} else if (in_array($sc, array('vc_message'))) {
			if (!empty($atts['closeable']) && (int) $atts['closeable']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_message_box_closeable';
		}
		return $classes;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (chocorocco_exists_visual_composer()) { require_once CHOCOROCCO_THEME_DIR . 'plugins/js_composer/js_composer.styles.php'; }
?>