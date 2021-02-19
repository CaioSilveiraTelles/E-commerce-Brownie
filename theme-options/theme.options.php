<?php
/**
 * Default Theme Options and Internal Theme Settings
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)


if ( !function_exists('chocorocco_options_theme_setup1') ) {
	add_action( 'after_setup_theme', 'chocorocco_options_theme_setup1', 1 );
	function chocorocco_options_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		chocorocco_storage_set('settings', array(
			
			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'max_load_fonts'		=> 3,			// Max fonts number to load from Google fonts or from uploaded fonts
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
		
			'max_excerpt_length'	=> 60,			// Max words number for the excerpt in the blog style 'Excerpt'.
													// For style 'Classic' - get half from this value

			'comment_maxlength'		=> 1000,		// Max length of the message from contact form

			'comment_after_name'	=> true,		// Place 'comment' field before the 'name' and 'email'
			
			'socials_type'			=> 'icons',		// Type of socials:
													// icons - use fontello icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_type'			=> 'icons',		// Type of other icons:
													// icons - use fontello icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_selector'		=> 'internal'	// Icons selector in the shortcodes:
													// vc (default) - standard VC icons selector (very slow and don't support images)
													// internal - internal popup with plugin's or theme's icons list (fast)
		));
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('chocorocco_options_create')) {

	function chocorocco_options_create() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __('<b>Attention!</b> Some of these options can be overridden in the following sections (Homepage, Blog archive, Shop, Events, etc.) or in the settings of individual pages', 'chocorocco');

		chocorocco_storage_set('options', array(
		
			// Section 'Title & Tagline' - add theme options in the standard WP section
			'title_tagline' => array(
				"title" => esc_html__('Title, Tagline & Site icon', 'chocorocco'),
				"desc" => wp_kses_data( __('Specify site title and tagline (if need) and upload the site icon', 'chocorocco') ),
				"type" => "section"
				),
		
		
			// Section 'Header' - add theme options in the standard WP section
			'header_image' => array(
				"title" => esc_html__('Header', 'chocorocco'),
				"desc" => wp_kses_data( __('Select or upload logo images, select header type and widgets set for the header', 'chocorocco') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'chocorocco'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'chocorocco')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style' => array(
				"title" => esc_html__('Header style', 'chocorocco'),
				"desc" => wp_kses_data( __('Select style to display the site header', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'chocorocco')
				),
				"std" => 'header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'chocorocco'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'chocorocco')
				),
				"std" => 'default',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'chocorocco'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'chocorocco'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'chocorocco') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'chocorocco'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'chocorocco')
				),
				"dependency" => array(
					'header_style' => array('header-default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => chocorocco_get_list_range(0,6),
				"type" => "select"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'chocorocco'),
				"desc" => wp_kses_data( __('Select color scheme to decorate header area', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'chocorocco')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'chocorocco'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'chocorocco')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'chocorocco'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'chocorocco')
				),
				"dependency" => array(
					'header_style' => array('header-default')
				),
				"std" => 1,
				"type" => "checkbox"
				),

			'menu_info' => array(
				"title" => esc_html__('Menu settings', 'chocorocco'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'chocorocco') ),
				"type" => "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'chocorocco'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'chocorocco')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'chocorocco'),
					'left'	=> esc_html__('Left',	'chocorocco'),
					'right'	=> esc_html__('Right',	'chocorocco')
				),
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Menu Color Scheme', 'chocorocco'),
				"desc" => wp_kses_data( __('Select color scheme to decorate main menu area', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'chocorocco')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'chocorocco'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'chocorocco') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'chocorocco'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'chocorocco') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'chocorocco'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'chocorocco') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo settings', 'chocorocco'),
				"desc" => wp_kses_data( __('Select logo images for the normal and Retina displays', 'chocorocco') ),
				"type" => "info"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'chocorocco'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'chocorocco') ),
				"std" => '',
				"type" => "image"
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'chocorocco'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'chocorocco') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse' => array(
				"title" => esc_html__('Logo inverse', 'chocorocco'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it on the dark background', 'chocorocco') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse_retina' => array(
				"title" => esc_html__('Logo inverse for Retina', 'chocorocco'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'chocorocco') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'chocorocco'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'chocorocco') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'chocorocco'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'chocorocco') ),
				"std" => '',
				"type" => "image"
				),
			'logo_text' => array(
				"title" => esc_html__('Logo from Site name', 'chocorocco'),
				"desc" => wp_kses_data( __('Do you want use Site name and description as Logo if images above are not selected?', 'chocorocco') ),
				"std" => 1,
				"type" => "checkbox"
				),
			
		
		
			// Section 'Content'
			'content' => array(
				"title" => esc_html__('Content', 'chocorocco'),
				"desc" => wp_kses_data( __('Options of the content area.', 'chocorocco') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'chocorocco'),
				"desc" => wp_kses_data( __('Select color scheme to decorate whole site. Attention! Case "Inherit" can be used only for custom pages, not for root site content in the Appearance - Customize', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'chocorocco')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'chocorocco'),
				"desc" => wp_kses_data( __('Select width of the body content', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'chocorocco')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => array(
					'boxed'		=> esc_html__('Boxed',		'chocorocco'),
					'wide'		=> esc_html__('Wide',		'chocorocco'),
					'fullwide'	=> esc_html__('Fullwide',	'chocorocco'),
					'fullscreen'=> esc_html__('Fullscreen',	'chocorocco')
				),
				"type" => "select"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'chocorocco'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'chocorocco') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'chocorocco')
				),
				"std" => '',
				"type" => "image"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'chocorocco'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'chocorocco') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'chocorocco')
				),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'chocorocco'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'chocorocco') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'chocorocco')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'chocorocco'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'chocorocco') ),
				"std" => 0,
				"type" => "text"
				),
			'no_image' => array(
				"title" => esc_html__('No image placeholder', 'chocorocco'),
				"desc" => wp_kses_data( __('Select or upload image, used as placeholder for the posts without featured image', 'chocorocco') ),
				"std" => '',
				"type" => "image"
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'chocorocco'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'chocorocco') ),
				"std" => 0,
				"type" => "checkbox"
				),
            'privacy_text' => array(
                "title" => esc_html__("Text with Privacy Policy link", 'chocorocco'),
                "desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'chocorocco') ),
                "std"   => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'chocorocco') ),
                "type"  => "text"
            ),
			'author_info' => array(
				"title" => esc_html__('Author info', 'chocorocco'),
				"desc" => wp_kses_data( __("Display block with information about post's author", 'chocorocco') ),
				"std" => 1,
				"type" => "checkbox"
				),
			'related_posts' => array(
				"title" => esc_html__('Related posts', 'chocorocco'),
				"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts showed.', 'chocorocco') ),
				"std" => 2,
				"options" => chocorocco_get_list_range(0,9),
				"type" => "select"
				),
			'related_columns' => array(
				"title" => esc_html__('Related columns', 'chocorocco'),
				"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page (from 2 to 4)?', 'chocorocco') ),
				"std" => 2,
				"options" => chocorocco_get_list_range(1,4),
				"type" => "select"
				),
			'related_style' => array(
				"title" => esc_html__('Related posts style', 'chocorocco'),
				"desc" => wp_kses_data( __('Select style of the related posts output', 'chocorocco') ),
				"std" => 2,
				"options" => chocorocco_get_list_styles(1,2),
				"type" => "select"
				),
			
		
		
			// Section 'Content'
			'sidebar' => array(
				"title" => esc_html__('Sidebar', 'chocorocco'),
				"desc" => wp_kses_data( __('Options of the sidebar area.', 'chocorocco') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section",
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'chocorocco'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'chocorocco') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'chocorocco')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'chocorocco'),
				"desc" => wp_kses_data( __('Select color scheme to decorate sidebar', 'chocorocco') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'chocorocco')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'chocorocco'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'chocorocco') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'chocorocco')
				),
				"refresh" => false,
				"std" => 'right',
				"options" => array(),
				"type" => "select"
				),
			'hide_sidebar_on_single' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'chocorocco'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'chocorocco') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets at the top of the page', 'chocorocco'),
				"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'chocorocco')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'chocorocco'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'chocorocco')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'chocorocco'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'chocorocco')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets at the bottom of the page', 'chocorocco'),
				"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'chocorocco')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
		
		
		
			// Section 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'chocorocco'),
				"desc" => wp_kses_data( __('Select set of widgets and columns number in the site footer', 'chocorocco') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section"
				),
			'footer_style' => array(
				"title" => esc_html__('Footer style', 'chocorocco'),
				"desc" => wp_kses_data( __('Select style to display the site footer', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Footer', 'chocorocco')
				),
				"std" => 'footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'chocorocco'),
				"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'chocorocco') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'chocorocco')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'chocorocco'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'chocorocco') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'chocorocco')
				),
				"dependency" => array(
					'footer_style' => array('footer-  
					default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'chocorocco'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'chocorocco') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'chocorocco')
				),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => chocorocco_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'chocorocco'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'chocorocco') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'chocorocco')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'chocorocco'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'chocorocco') ),
				'refresh' => false,
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'chocorocco'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'chocorocco') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'chocorocco'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'chocorocco') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'chocorocco'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'chocorocco') ),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'chocorocco'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'chocorocco') ),
				"std" => esc_html__('AncoraThemes &copy; {Y}. All rights reserved.', 'chocorocco'),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
		
		
		
			// Section 'Homepage' - settings for home page
			'homepage' => array(
				"title" => esc_html__('Homepage', 'chocorocco'),
				"desc" => wp_kses_data( __('Select blog style and widgets to display on the homepage', 'chocorocco') ),
				"type" => "section"
				),
			'expand_content_home' => array(
				"title" => esc_html__('Expand content', 'chocorocco'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the Homepage', 'chocorocco') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style_home' => array(
				"title" => esc_html__('Blog style', 'chocorocco'),
				"desc" => wp_kses_data( __('Select posts style for the homepage', 'chocorocco') ),
				"std" => 'excerpt',
				"options" => array(),
				"type" => "select"
				),
			'first_post_large_home' => array(
				"title" => esc_html__('First post large', 'chocorocco'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of the Homepage', 'chocorocco') ),
				"dependency" => array(
					'blog_style_home' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style_home' => array(
				"title" => esc_html__('Header style', 'chocorocco'),
				"desc" => wp_kses_data( __('Select style to display the site header on the homepage', 'chocorocco') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_position_home' => array(
				"title" => esc_html__('Header position', 'chocorocco'),
				"desc" => wp_kses_data( __('Select position to display the site header on the homepage', 'chocorocco') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets_home' => array(
				"title" => esc_html__('Header widgets', 'chocorocco'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the homepage', 'chocorocco') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_widgets_home' => array(
				"title" => esc_html__('Sidebar widgets', 'chocorocco'),
				"desc" => wp_kses_data( __('Select sidebar to show on the homepage', 'chocorocco') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_position_home' => array(
				"title" => esc_html__('Sidebar position', 'chocorocco'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the homepage', 'chocorocco') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_page_home' => array(
				"title" => esc_html__('Widgets above the page', 'chocorocco'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'chocorocco') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content_home' => array(
				"title" => esc_html__('Widgets above the content', 'chocorocco'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'chocorocco') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content_home' => array(
				"title" => esc_html__('Widgets below the content', 'chocorocco'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'chocorocco') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page_home' => array(
				"title" => esc_html__('Widgets below the page', 'chocorocco'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'chocorocco') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			
		
		
			// Section 'Blog archive'
			'blog' => array(
				"title" => esc_html__('Blog archive', 'chocorocco'),
				"desc" => wp_kses_data( __('Options for the blog archive', 'chocorocco') ),
				"type" => "section",
				),
			'expand_content_blog' => array(
				"title" => esc_html__('Expand content', 'chocorocco'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the blog archive', 'chocorocco') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style' => array(
				"title" => esc_html__('Blog style', 'chocorocco'),
				"desc" => wp_kses_data( __('Select posts style for the blog archive', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'chocorocco')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"std" => 'excerpt',
				"options" => array(),
				"type" => "select"
				),
			'blog_columns' => array(
				"title" => esc_html__('Blog columns', 'chocorocco'),
				"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'chocorocco') ),
				"std" => 2,
				"options" => chocorocco_get_list_range(2,4),
				"type" => "hidden"
				),
			'post_type' => array(
				"title" => esc_html__('Post type', 'chocorocco'),
				"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'chocorocco')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"linked" => 'parent_cat',
				"refresh" => false,
				"hidden" => true,
				"std" => 'post',
				"options" => array(),
				"type" => "select"
				),
			'parent_cat' => array(
				"title" => esc_html__('Category to show', 'chocorocco'),
				"desc" => wp_kses_data( __('Select category to show in the blog archive', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'chocorocco')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"refresh" => false,
				"hidden" => true,
				"std" => '0',
				"options" => array(),
				"type" => "select"
				),
			'posts_per_page' => array(
				"title" => esc_html__('Posts per page', 'chocorocco'),
				"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'chocorocco')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'meta_parts' => array(
				"title" => esc_html__('Post meta', 'chocorocco'),
				"desc" => wp_kses_data( __("Select elements to show in the post meta area on default blog archive and search results. If your blog archive created by page with parameter 'Page template' equal to 'Blog archive' - please set up parameter 'Post meta' in the 'Theme Options' section of this page. Attention! You can drag items to change their order", 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'chocorocco')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"dir" => 'vertical',
				"sortable" => true,
				"std" => 'categories=0|date=1|counters=1|author=1|share=0|edit=0',
				"options" => array(
					'categories' => esc_html__('Categories', 'chocorocco'),
					'date'		 => esc_html__('Post date', 'chocorocco'),
					'author'	 => esc_html__('Post author', 'chocorocco'),
					'counters'	 => esc_html__('Post counters', 'chocorocco'),
					'share'		 => esc_html__('Share links', 'chocorocco'),
					'edit'		 => esc_html__('Edit link', 'chocorocco')
				),
				"type" => "checklist"
			),
			'counters' => array(
				"title" => esc_html__('Counters', 'chocorocco'),
				"desc" => wp_kses_data( __("Select counters to show in the post meta area on default blog archive and search results. If your blog archive created by page with parameter 'Page template' equal to 'Blog archive' - please set up parameter 'Counters' in the 'Theme Options' section of this page. Attention! You can drag items to change their order. Likes and Views available only if ThemeREX Addons is active", 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'chocorocco')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"dir" => 'vertical',
				"sortable" => true,
				"std" => 'views=1|likes=1|comments=1',
				"options" => array(
					'views' => esc_html__('Views', 'chocorocco'),
					'likes' => esc_html__('Likes', 'chocorocco'),
					'comments' => esc_html__('Comments', 'chocorocco')
				),
				"type" => "checklist"
			),
			"blog_pagination" => array( 
				"title" => esc_html__('Pagination style', 'chocorocco'),
				"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'chocorocco')
				),
				"std" => "pages",
				"options" => array(
					'pages'	=> esc_html__("Page numbers", 'chocorocco'),
					'links'	=> esc_html__("Older/Newest", 'chocorocco'),
					'more'	=> esc_html__("Load more", 'chocorocco'),
					'infinite' => esc_html__("Infinite scroll", 'chocorocco')
				),
				"type" => "select"
				),
			'show_filters' => array(
				"title" => esc_html__('Show filters', 'chocorocco'),
				"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'chocorocco')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
					'blog_style' => array('portfolio', 'gallery')
				),
				"hidden" => true,
				"std" => 0,
				"type" => "checkbox"
				),
			'first_post_large' => array(
				"title" => esc_html__('First post large', 'chocorocco'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of blog archive', 'chocorocco') ),
				"dependency" => array(
					'blog_style' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			"blog_content" => array( 
				"title" => esc_html__('Posts content', 'chocorocco'),
				"desc" => wp_kses_data( __("Show full post's content in the blog or only post's excerpt", 'chocorocco') ),
				"std" => "excerpt",
				"options" => array(
					'excerpt'	=> esc_html__('Excerpt',	'chocorocco'),
					'fullpost'	=> esc_html__('Full post',	'chocorocco')
				),
				"type" => "select"
				),
			'time_diff_before' => array(
				"title" => esc_html__('Time difference', 'chocorocco'),
				"desc" => wp_kses_data( __("How many days show time difference instead post's date", 'chocorocco') ),
				"std" => 5,
				"type" => "text"
				),
			'sticky_style' => array(
				"title" => esc_html__('Sticky posts style', 'chocorocco'),
				"desc" => wp_kses_data( __('Select style of the sticky posts output', 'chocorocco') ),
				"std" => 'inherit',
				"options" => array(
					'inherit' => esc_html__('Decorated posts', 'chocorocco'),
					'columns' => esc_html__('Mini-cards',	'chocorocco')
				),
				"type" => "select"
				),
			"blog_animation" => array( 
				"title" => esc_html__('Animation for the posts', 'chocorocco'),
				"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'chocorocco')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"std" => "none",
				"options" => array(),
				"type" => "select"
				),
			'header_style_blog' => array(
				"title" => esc_html__('Header style', 'chocorocco'),
				"desc" => wp_kses_data( __('Select style to display the site header on the blog archive', 'chocorocco') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_position_blog' => array(
				"title" => esc_html__('Header position', 'chocorocco'),
				"desc" => wp_kses_data( __('Select position to display the site header on the blog archive', 'chocorocco') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets_blog' => array(
				"title" => esc_html__('Header widgets', 'chocorocco'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the blog archive', 'chocorocco') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_widgets_blog' => array(
				"title" => esc_html__('Sidebar widgets', 'chocorocco'),
				"desc" => wp_kses_data( __('Select sidebar to show on the blog archive', 'chocorocco') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_position_blog' => array(
				"title" => esc_html__('Sidebar position', 'chocorocco'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the blog archive', 'chocorocco') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'hide_sidebar_on_single_blog' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'chocorocco'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post", 'chocorocco') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page_blog' => array(
				"title" => esc_html__('Widgets above the page', 'chocorocco'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'chocorocco') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content_blog' => array(
				"title" => esc_html__('Widgets above the content', 'chocorocco'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'chocorocco') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content_blog' => array(
				"title" => esc_html__('Widgets below the content', 'chocorocco'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'chocorocco') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page_blog' => array(
				"title" => esc_html__('Widgets below the page', 'chocorocco'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'chocorocco') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			
		
		
			// Section 'Colors' - choose color scheme and customize separate colors from it
			'scheme' => array(
				"title" => esc_html__('* Color scheme editor', 'chocorocco'),
				"desc" => esc_html__("Modify colors and preview changes on your site", 'chocorocco'),
				"priority" => 1000,
				"type" => "section"
				),
		
			'scheme_storage' => array(
				"title" => esc_html__('Color schemes', 'chocorocco'),
				"desc" => esc_html__('Select color scheme to modify. Attention! Only those sections will be changed which this scheme was assigned to', 'chocorocco'),
				"std" => '$chocorocco_get_scheme_storage',
				"refresh" => false,
				"type" => "scheme_editor"
				),


			// Section 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'chocorocco'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'chocorocco') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'chocorocco')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'chocorocco'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'chocorocco') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'chocorocco')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// Panel 'Fonts' - manage fonts loading and set parameters of the base theme elements
			'fonts' => array(
				"title" => esc_html__('* Fonts settings', 'chocorocco'),
				"desc" => '',
				"priority" => 1500,
				"type" => "panel"
				),

			// Section 'Load_fonts'
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'chocorocco'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'chocorocco') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'chocorocco') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'chocorocco'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'chocorocco') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'chocorocco') ),
				"refresh" => false,
				"std" => '$chocorocco_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=chocorocco_get_theme_setting('max_load_fonts'); $i++) {
			$fonts["load_fonts-{$i}-info"] = array(
				"title" => esc_html(sprintf(__('Font %s', 'chocorocco'), $i)),
				"desc" => '',
				"type" => "info",
				);
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'chocorocco'),
				"desc" => '',
				"refresh" => false,
				"std" => '$chocorocco_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'chocorocco'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'chocorocco') )
							: '',
				"refresh" => false,
				"std" => '$chocorocco_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'chocorocco'),
					'serif' => esc_html__('serif', 'chocorocco'),
					'sans-serif' => esc_html__('sans-serif', 'chocorocco'),
					'monospace' => esc_html__('monospace', 'chocorocco'),
					'cursive' => esc_html__('cursive', 'chocorocco'),
					'fantasy' => esc_html__('fantasy', 'chocorocco')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'chocorocco'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'chocorocco') )
											. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'chocorocco') )
							: '',
				"refresh" => false,
				"std" => '$chocorocco_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Sections with font's attributes for each theme element
		$theme_fonts = chocorocco_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(__('%s settings', 'chocorocco'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'chocorocco'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'chocorocco'),
						'100' => esc_html__('100 (Light)', 'chocorocco'), 
						'200' => esc_html__('200 (Light)', 'chocorocco'), 
						'300' => esc_html__('300 (Thin)',  'chocorocco'),
						'400' => esc_html__('400 (Normal)', 'chocorocco'),
						'500' => esc_html__('500 (Semibold)', 'chocorocco'),
						'600' => esc_html__('600 (Semibold)', 'chocorocco'),
						'700' => esc_html__('700 (Bold)', 'chocorocco'),
						'800' => esc_html__('800 (Black)', 'chocorocco'),
						'900' => esc_html__('900 (Black)', 'chocorocco')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'chocorocco'),
						'normal' => esc_html__('Normal', 'chocorocco'), 
						'italic' => esc_html__('Italic', 'chocorocco')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'chocorocco'),
						'none' => esc_html__('None', 'chocorocco'), 
						'underline' => esc_html__('Underline', 'chocorocco'),
						'overline' => esc_html__('Overline', 'chocorocco'),
						'line-through' => esc_html__('Line-through', 'chocorocco')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'chocorocco'),
						'none' => esc_html__('None', 'chocorocco'), 
						'uppercase' => esc_html__('Uppercase', 'chocorocco'),
						'lowercase' => esc_html__('Lowercase', 'chocorocco'),
						'capitalize' => esc_html__('Capitalize', 'chocorocco')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"refresh" => false,
					"std" => '$chocorocco_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters into Theme Options
		chocorocco_storage_merge_array('options', '', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			chocorocco_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'chocorocco'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'chocorocco') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'chocorocco')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('chocorocco_options_get_list_choises')) {
	add_filter('chocorocco_filter_options_get_list_choises', 'chocorocco_options_get_list_choises', 10, 2);
	function chocorocco_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = chocorocco_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = chocorocco_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = chocorocco_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (strpos($id, 'header_scheme')===0 
					|| strpos($id, 'menu_scheme')===0
					|| strpos($id, 'color_scheme')===0
					|| strpos($id, 'sidebar_scheme')===0
					|| strpos($id, 'footer_scheme')===0)
				$list = chocorocco_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = chocorocco_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = chocorocco_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = chocorocco_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = chocorocco_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = chocorocco_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = chocorocco_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = chocorocco_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = chocorocco_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = chocorocco_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = chocorocco_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = chocorocco_array_merge(array(0 => esc_html__('- Select category -', 'chocorocco')), chocorocco_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = chocorocco_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = chocorocco_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = chocorocco_get_list_load_fonts(true);
		}
		return $list;
	}
}




// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if (!function_exists('chocorocco_options_theme_setup2')) {
	add_action( 'after_setup_theme', 'chocorocco_options_theme_setup2', 2 );
	function chocorocco_options_theme_setup2() {
		chocorocco_options_create();
	}
}

// Step 1: Load default settings and previously saved mods
if (!function_exists('chocorocco_options_theme_setup5')) {
	add_action( 'after_setup_theme', 'chocorocco_options_theme_setup5', 5 );
	function chocorocco_options_theme_setup5() {
		chocorocco_storage_set('options_reloaded', false);
		chocorocco_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if (is_customize_preview()) {
	if (!function_exists('chocorocco_load_custom_options')) {
		add_action( 'wp_loaded', 'chocorocco_load_custom_options' );
		function chocorocco_load_custom_options() {
			if (!chocorocco_storage_get('options_reloaded')) {
				chocorocco_storage_set('options_reloaded', true);
				chocorocco_load_theme_options();
			}
		}
	}
}

// Load current values for each customizable option
if ( !function_exists('chocorocco_load_theme_options') ) {
	function chocorocco_load_theme_options() {
		$options = chocorocco_storage_get('options');
		$reset = (int) get_theme_mod('reset_options', 0);
		foreach ($options as $k=>$v) {
			if (isset($v['std'])) {
				if (strpos($v['std'], '$chocorocco_')!==false) {
					$func = substr($v['std'], 1);
					if (function_exists($func)) {
						$v['std'] = $func($k);
					}
				}
				$value = $v['std'];
				if (!$reset) {
					if (isset($_GET[$k]))
						$value = $_GET[$k];
					else {
						$tmp = get_theme_mod($k, -987654321);
						if ($tmp != -987654321) $value = $tmp;
					}
				}
				chocorocco_storage_set_array2('options', $k, 'val', $value);
				if ($reset) remove_theme_mod($k);
			}
		}
		if ($reset) {
			// Unset reset flag
			set_theme_mod('reset_options', 0);
			// Regenerate CSS with default colors and fonts
			chocorocco_customizer_save_css();
		} else {
			do_action('chocorocco_action_load_options');
		}
	}
}

// Override options with stored page/post meta
if ( !function_exists('chocorocco_override_theme_options') ) {
	add_action( 'wp', 'chocorocco_override_theme_options', 1 );
	function chocorocco_override_theme_options($query=null) {
		if (is_page_template('blog.php')) {
			chocorocco_storage_set('blog_archive', true);
			chocorocco_storage_set('blog_template', get_the_ID());
		}
		chocorocco_storage_set('blog_mode', chocorocco_detect_blog_mode());
		if (is_singular()) {
			chocorocco_storage_set('options_meta', get_post_meta(get_the_ID(), 'chocorocco_options', true));
		}
	}
}


// Return customizable option value
if (!function_exists('chocorocco_get_theme_option')) {
	function chocorocco_get_theme_option($name, $defa='', $strict_mode=false, $post_id=0) {
		$rez = $defa;
		$from_post_meta = false;
		if ($post_id > 0) {
			if (!chocorocco_storage_isset('post_options_meta', $post_id))
				chocorocco_storage_set_array('post_options_meta', $post_id, get_post_meta($post_id, 'chocorocco_options', true));
			if (chocorocco_storage_isset('post_options_meta', $post_id, $name)) {
				$tmp = chocorocco_storage_get_array('post_options_meta', $post_id, $name);
				if (!chocorocco_is_inherit($tmp)) {
					$rez = $tmp;
					$from_post_meta = true;
				}
			}
		}
		if (!$from_post_meta && chocorocco_storage_isset('options')) {
			$blog_mode = chocorocco_storage_get('blog_mode');
			if ( !chocorocco_storage_isset('options', $name) && (empty($blog_mode) || !chocorocco_storage_isset('options', $name.'_'.$blog_mode)) ) {
				$rez = $tmp = '_not_exists_';
				if (function_exists('trx_addons_get_option'))
					$rez = trx_addons_get_option($name, $tmp, false);
				if ($rez === $tmp) {
					if ($strict_mode) {
						$s = debug_backtrace();
						//array_shift($s);
						$s = array_shift($s);
						echo '<pre>' . sprintf(esc_html__('Undefined option "%s" called from:', 'chocorocco'), $name);
						if (function_exists('dco')) dco($s);
						else print_r($s);
						echo '</pre>';
						die();
					} else
						$rez = $defa;
				}
			} else {
				// Override option from GET or POST for current blog mode
				if (!empty($blog_mode) && isset($_REQUEST[$name . '_' . $blog_mode])) {
					$rez = $_REQUEST[$name . '_' . $blog_mode];
				// Override option from GET
				} else if (isset($_REQUEST[$name])) {
					$rez = $_REQUEST[$name];
				// Override option from current page settings (if exists)
				} else if (chocorocco_storage_isset('options_meta', $name) && !chocorocco_is_inherit(chocorocco_storage_get_array('options_meta', $name))) {
					$rez = chocorocco_storage_get_array('options_meta', $name);
				// Override option from current blog mode settings: 'home', 'search', 'page', 'post', 'blog', etc. (if exists)
				} else if (!empty($blog_mode) && chocorocco_storage_isset('options', $name . '_' . $blog_mode, 'val') && !chocorocco_is_inherit(chocorocco_storage_get_array('options', $name . '_' . $blog_mode, 'val'))) {
					$rez = chocorocco_storage_get_array('options', $name . '_' . $blog_mode, 'val');
				// Get saved option value
				} else if (chocorocco_storage_isset('options', $name, 'val')) {
					$rez = chocorocco_storage_get_array('options', $name, 'val');
				// Get ThemeREX Addons option value
				} else if (function_exists('trx_addons_get_option')) {
					$rez = trx_addons_get_option($name, $defa, false);
				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if (!function_exists('chocorocco_check_theme_option')) {
	function chocorocco_check_theme_option($name) {
		return chocorocco_storage_isset('options', $name);
	}
}


// Return customizable option value, stored in the posts meta
if (!function_exists('chocorocco_get_theme_option_from_meta')) {
	function chocorocco_get_theme_option_from_meta($name, $defa='') {
		$rez = $defa;
		if (chocorocco_storage_isset('options_meta')) {
			if (chocorocco_storage_isset('options_meta', $name))
				$rez = chocorocco_storage_get_array('options_meta', $name);
			else
				$rez = 'inherit';
		}
		return $rez;
	}
}


// Get dependencies list from the Theme Options
if ( !function_exists('chocorocco_get_theme_dependencies') ) {
	function chocorocco_get_theme_dependencies() {
		$options = chocorocco_storage_get('options');
		$depends = array();
		foreach ($options as $k=>$v) {
			if (isset($v['dependency'])) 
				$depends[$k] = $v['dependency'];
		}
		return $depends;
	}
}

// Return internal theme setting value
if (!function_exists('chocorocco_get_theme_setting')) {
	function chocorocco_get_theme_setting($name) {
		if ( !chocorocco_storage_isset('settings', $name) ) {
			$s = debug_backtrace();
			//array_shift($s);
			$s = array_shift($s);
			echo '<pre>' . sprintf(esc_html__('Undefined setting "%s" called from:', 'chocorocco'), $name);
			if (function_exists('dco')) dco($s);
			else print_r($s);
			echo '</pre>';
			die();
		} else
			return chocorocco_storage_get_array('settings', $name);
	}
}

// Set theme setting
if ( !function_exists( 'chocorocco_set_theme_setting' ) ) {
	function chocorocco_set_theme_setting($option_name, $value) {
		if (chocorocco_storage_isset('settings', $option_name))
			chocorocco_storage_set_array('settings', $option_name, $value);
	}
}
?>