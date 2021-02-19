<?php
/* Visual Composer Extensions Bundle support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('chocorocco_vc_extensions_theme_setup9')) {
	add_action( 'after_setup_theme', 'chocorocco_vc_extensions_theme_setup9', 9 );
	function chocorocco_vc_extensions_theme_setup9() {
		if (chocorocco_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 								'chocorocco_vc_extensions_frontend_scripts', 1100 );
			add_filter( 'chocorocco_filter_merge_styles',						'chocorocco_vc_extensions_merge_styles' );
		}
	
		if (is_admin()) {
			add_filter( 'chocorocco_filter_tgmpa_required_plugins',		'chocorocco_vc_extensions_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'chocorocco_vc_extensions_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('chocorocco_filter_tgmpa_required_plugins',	'chocorocco_vc_extensions_tgmpa_required_plugins');
	function chocorocco_vc_extensions_tgmpa_required_plugins($list=array()) {
		if (in_array('vc-extensions-bundle', chocorocco_storage_get('required_plugins'))) {
			$path = chocorocco_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.zip');
			$list[] = array(
					'name' 		=> esc_html__('Visual Composer Extensions Bundle', 'chocorocco'),
					'slug' 		=> 'vc-extensions-bundle',
					'source'	=> !empty($path) ? $path : 'upload://vc-extensions-bundle.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if VC Extensions installed and activated
if ( !function_exists( 'chocorocco_exists_vc_extensions' ) ) {
	function chocorocco_exists_vc_extensions() {
		return class_exists('Vc_Manager') && class_exists('VC_Extensions_CQBundle');
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'chocorocco_vc_extensions_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'chocorocco_vc_extensions_frontend_scripts', 1100 );
	function chocorocco_vc_extensions_frontend_scripts() {
		if (chocorocco_is_on(chocorocco_get_theme_option('debug_mode')) && chocorocco_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.css')!='')
			wp_enqueue_style( 'chocorocco-vc-extensions-bundle',  chocorocco_get_file_url('plugins/vc-extensions-bundle/vc-extensions-bundle.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'chocorocco_vc_extensions_merge_styles' ) ) {
	//Handler of the add_filter('chocorocco_filter_merge_styles', 'chocorocco_vc_extensions_merge_styles');
	function chocorocco_vc_extensions_merge_styles($list) {
		$list[] = 'plugins/vc-extensions-bundle/vc-extensions-bundle.css';
		return $list;
	}
}
?>