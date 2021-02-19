<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0.22
 */

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
if ( !function_exists('chocorocco_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'chocorocco_customizer_theme_setup1', 1 );
	function chocorocco_customizer_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		chocorocco_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Abril Fatface',
				'family' => 'cursive'
				),
			// Font-face packed with theme
			array(
				'name'   => 'Droid Serif',
				'family' => 'serif',
                'styles' => '400,400italic,700,700italic'
				),
            array(
                'name'   => 'Fjalla One',
                'family' => 'sans-serif'
            )
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		chocorocco_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		chocorocco_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'chocorocco'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'chocorocco'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '15px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '25px',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.6em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'chocorocco'),
				'font-family'		=> 'Abril Fatface, cursive',
				'font-size' 		=> '4.667em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.9583em',
				'margin-bottom'		=> '0.5833em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'chocorocco'),
				'font-family'		=> 'Abril Fatface, cursive',
				'font-size' 		=> '3.333em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.1em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '1.3em',
				'margin-bottom'		=> '1.05em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'chocorocco'),
				'font-family'		=> 'Abril Fatface, cursive',
				'font-size' 		=> '2.533em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.26em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '1.87em',
				'margin-bottom'		=> '1.04em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'chocorocco'),
				'font-family'		=> 'Abril Fatface, cursive',
				'font-size' 		=> '2em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.33em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '2.4em',
				'margin-bottom'		=> '0.8em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'chocorocco'),
				'font-family'		=> 'Fjalla One, sans-serif',
				'font-size' 		=> '1.667em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.32em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '3.4em',
				'margin-bottom'		=> '0.8em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'chocorocco'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '1.067em',
				'font-weight'		=> '700',
				'font-style'		=> 'italic',
				'line-height'		=> '1.56em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '3.3176em',
				'margin-bottom'		=> '1.2em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'chocorocco'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'chocorocco'),
				'font-family'		=> 'Abril Fatface, cursive',
				'font-size' 		=> '2.667em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'chocorocco'),
				'font-family'		=> 'Fjalla One, sans-serif',
				'font-size' 		=> '1.067em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1.5px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'chocorocco'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'chocorocco'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'chocorocco'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'chocorocco'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '1.067em',
				'font-weight'		=> '700',
				'font-style'		=> 'italic',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'chocorocco'),
				'description'		=> esc_html__('Font settings of the main menu items', 'chocorocco'),
				'font-family'		=> 'Fjalla One, sans-serif',
				'font-size' 		=> '16px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1.4px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'chocorocco'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'chocorocco'),
				'font-family'		=> 'Fjalla One,sans-serif',
				'font-size' 		=> '16px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1.4px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		chocorocco_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> __('Main', 'chocorocco'),
							'description'	=> __('Colors of the main content area', 'chocorocco')
							),
			'alter'	=> array(
							'title'			=> __('Alter', 'chocorocco'),
							'description'	=> __('Colors of the alternative blocks (sidebars, etc.)', 'chocorocco')
							),
			'extra'	=> array(
							'title'			=> __('Extra', 'chocorocco'),
							'description'	=> __('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'chocorocco')
							),
			'inverse' => array(
							'title'			=> __('Inverse', 'chocorocco'),
							'description'	=> __('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'chocorocco')
							),
			'input'	=> array(
							'title'			=> __('Input', 'chocorocco'),
							'description'	=> __('Colors of the form fields (text field, textarea, select, etc.)', 'chocorocco')
							),
			)
		);
		chocorocco_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> __('Background color', 'chocorocco'),
							'description'	=> __('Background color of this block in the normal state', 'chocorocco')
							),
			'bg_hover'	=> array(
							'title'			=> __('Background hover', 'chocorocco'),
							'description'	=> __('Background color of this block in the hovered state', 'chocorocco')
							),
			'bd_color'	=> array(
							'title'			=> __('Border color', 'chocorocco'),
							'description'	=> __('Border color of this block in the normal state', 'chocorocco')
							),
			'bd_hover'	=>  array(
							'title'			=> __('Border hover', 'chocorocco'),
							'description'	=> __('Border color of this block in the hovered state', 'chocorocco')
							),
			'text'		=> array(
							'title'			=> __('Text', 'chocorocco'),
							'description'	=> __('Color of the plain text inside this block', 'chocorocco')
							),
			'text_dark'	=> array(
							'title'			=> __('Text dark', 'chocorocco'),
							'description'	=> __('Color of the dark text (bold, header, etc.) inside this block', 'chocorocco')
							),
			'text_light'=> array(
							'title'			=> __('Text light', 'chocorocco'),
							'description'	=> __('Color of the light text (post meta, etc.) inside this block', 'chocorocco')
							),
			'text_link'	=> array(
							'title'			=> __('Link', 'chocorocco'),
							'description'	=> __('Color of the links inside this block', 'chocorocco')
							),
			'text_hover'=> array(
							'title'			=> __('Link hover', 'chocorocco'),
							'description'	=> __('Color of the hovered state of links inside this block', 'chocorocco')
							),
			'text_link2'=> array(
							'title'			=> __('Link 2', 'chocorocco'),
							'description'	=> __('Color of the accented texts (areas) inside this block', 'chocorocco')
							),
			'text_hover2'=> array(
							'title'			=> __('Link 2 hover', 'chocorocco'),
							'description'	=> __('Color of the hovered state of accented texts (areas) inside this block', 'chocorocco')
							),
			'text_link3'=> array(
							'title'			=> __('Link 3', 'chocorocco'),
							'description'	=> __('Color of the other accented texts (buttons) inside this block', 'chocorocco')
							),
			'text_hover3'=> array(
							'title'			=> __('Link 3 hover', 'chocorocco'),
							'description'	=> __('Color of the hovered state of other accented texts (buttons) inside this block', 'chocorocco')
							)
			)
		);
		chocorocco_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'chocorocco'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff',
					'bd_color'			=> '#f0efe9',       //
		
					// Text and links colors
					'text'				=> '#a0916d',       //
					'text_light'		=> '#f1ce7e',       //
					'text_dark'			=> '#5a4f45',       //
					'text_link'			=> '#f0c96a',       //
					'text_hover'		=> '#a1926e',       //
					'text_link2'		=> '#a79a7a',       //
					'text_hover2'		=> '#7f6b3c',   //
					'text_link3'		=> '#93d3d9;',      //
					'text_hover3'		=> '#7ada9e',       //

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#f1efea',   //
					'alter_bg_hover'	=> '#e6e8eb',
					'alter_bd_color'	=> '#f0eee9',   //
					'alter_bd_hover'	=> '#dadada',
					'alter_text'		=> '#645745',   //
					'alter_light'		=> '#b7b7b7',
					'alter_dark'		=> '#5a4f45',  //
					'alter_link'		=> '#fe7259',
					'alter_hover'		=> '#72cfd5',
					'alter_link2'		=> '#80d572',
					'alter_hover2'		=> '#8be77c',
					'alter_link3'		=> '#ddb837',
					'alter_hover3'		=> '#eec432',
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1e1d22',
					'extra_bg_hover'	=> '#28272e',
					'extra_bd_color'	=> '#313131',
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#bfbfbf',
					'extra_light'		=> '#afafaf',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#72cfd5',
					'extra_hover'		=> '#fe7259',
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#ffffff',   //
					'input_bg_hover'	=> '#ffffff',   //
					'input_bd_color'	=> '#a1926e',   //
					'input_bd_hover'	=> '#f2cf7f',   //
					'input_text'		=> '#a0916d',   //
					'input_light'		=> '#a0916d',   //
					'input_dark'		=> '#a0916d',   //
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#67bcc1',
					'inverse_bd_hover'	=> '#5aa4a9',
					'inverse_text'		=> '#ffffff',       //
					'inverse_light'		=> '#a0916d',
					'inverse_dark'		=> '#5a4f45',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'chocorocco'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#0e0d12',
					'bd_color'			=> '#1c1b1f',
		
					// Text and links colors
					'text'				=> '#b7b7b7',
					'text_light'		=> '#5f5f5f',
					'text_dark'			=> '#ffffff',
                    'text_link'			=> '#f0c96a',       //
                    'text_hover'		=> '#a1926e',       //
                    'text_link2'		=> '#a79a7a',       //
                    'text_hover2'		=> '#8be77c',
                    'text_link3'		=> '#93d3d9;',      //
                    'text_hover3'		=> '#7ada9e',       //

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#1e1d22',
					'alter_bg_hover'	=> '#28272e',
					'alter_bd_color'	=> '#313131',
					'alter_bd_hover'	=> '#3d3d3d',
					'alter_text'		=> '#a6a6a6',
					'alter_light'		=> '#5f5f5f',
					'alter_dark'		=> '#ffffff',
					'alter_link'		=> '#f0c96a',
					'alter_hover'		=> '#fe7259',
					'alter_link2'		=> '#80d572',
					'alter_hover2'		=> '#8be77c',
					'alter_link3'		=> '#ddb837',
					'alter_hover3'		=> '#eec432',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1e1d22',
					'extra_bg_hover'	=> '#28272e',
					'extra_bd_color'	=> '#313131',
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#a6a6a6',
					'extra_light'		=> '#5f5f5f',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#f0c96a',
					'extra_hover'		=> '#fe7259',
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#a0916d',
					'input_bg_hover'	=> '#a0916d',
					'input_bd_color'	=> '#a0916d',
					'input_bd_hover'	=> '#353535',
					'input_text'		=> '#b7b7b7',
					'input_light'		=> '#5f5f5f',
					'input_dark'		=> '#ffffff',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#e36650',
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#ffffff',     //
					'inverse_light'		=> '#a0916d',
					'inverse_dark'		=> '#5a4f45',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			)
		
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('chocorocco_customizer_add_theme_colors')) {
	function chocorocco_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = chocorocco_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = chocorocco_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_04']  = chocorocco_hex2rgba( $colors['bg_color'], 0.4 );
			$colors['bg_color_07']  = chocorocco_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = chocorocco_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = chocorocco_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_color_07']  = chocorocco_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = chocorocco_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = chocorocco_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = chocorocco_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['extra_bg_color_07']  = chocorocco_hex2rgba( $colors['extra_bg_color'], 0.7 );
			$colors['text_dark_07']  = chocorocco_hex2rgba( $colors['text_dark'], 0.7 );
            $colors['inverse_dark_05']  = chocorocco_hex2rgba( $colors['inverse_dark'], 0.5 );
            $colors['inverse_text_02']  = chocorocco_hex2rgba( $colors['inverse_text'], 0.2 );
            $colors['inverse_text_04']  = chocorocco_hex2rgba( $colors['inverse_text'], 0.4 );
            $colors['alter_text_04']  = chocorocco_hex2rgba( $colors['alter_text'], 0.4 );
            $colors['inverse_link_04']  = chocorocco_hex2rgba( $colors['inverse_link'], 0.4 );
            $colors['text_link_02']  = chocorocco_hex2rgba( $colors['text_link'], 0.2 );
            $colors['text_link2_04']  = chocorocco_hex2rgba( $colors['text_link2'], 0.4 );
			$colors['text_link_07']  = chocorocco_hex2rgba( $colors['text_link'], 0.7 );
			$colors['text_link_blend'] = chocorocco_hsb2hex(chocorocco_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = chocorocco_hsb2hex(chocorocco_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['extra_bg_color_07'] = '{{ data.extra_bg_color_07 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('chocorocco_customizer_add_theme_fonts')) {
	function chocorocco_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			//$rez[$tag] = $font;
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !chocorocco_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !chocorocco_is_inherit($font['font-size'])
														? 'font-size:' . chocorocco_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !chocorocco_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !chocorocco_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !chocorocco_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !chocorocco_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !chocorocco_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !chocorocco_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !chocorocco_is_inherit($font['margin-top'])
														? 'margin-top:' . chocorocco_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !chocorocco_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . chocorocco_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}


//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('chocorocco_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'chocorocco_customizer_theme_setup' );
	function chocorocco_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('chocorocco_filter_add_thumb_sizes', array(
			'chocorocco-thumb-huge'		=> array(1170, 658, true),
			'chocorocco-thumb-big' 		=> array( 760, 410, true),
			'chocorocco-thumb-med' 		=> array( 370, 272, true),
			'chocorocco-thumb-square' 		=> array( 500, 500, true),
			'chocorocco-thumb-tiny' 		=> array(  90,  90, true),
			'chocorocco-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'chocorocco-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = chocorocco_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'chocorocco_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('chocorocco_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'chocorocco_customizer_image_sizes' );
	function chocorocco_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('chocorocco_filter_add_thumb_sizes', array(
			'chocorocco-thumb-huge'		=> esc_html__( 'Fullsize image', 'chocorocco' ),
			'chocorocco-thumb-big'			=> esc_html__( 'Large image', 'chocorocco' ),
			'chocorocco-thumb-med'			=> esc_html__( 'Medium image', 'chocorocco' ),
			'chocorocco-thumb-tiny'		=> esc_html__( 'Small square avatar', 'chocorocco' ),
			'chocorocco-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'chocorocco' ),
			'chocorocco-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'chocorocco' ),
			)
		);
		$mult = chocorocco_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'chocorocco' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'chocorocco_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'chocorocco_customizer_trx_addons_add_thumb_sizes');
	function chocorocco_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'chocorocco_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'chocorocco_customizer_trx_addons_get_thumb_size');
	function chocorocco_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
            'trx_addons-thumb-square',
            'trx_addons-thumb-square-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'chocorocco-thumb-huge',
							'chocorocco-thumb-huge-@retina',
							'chocorocco-thumb-big',
							'chocorocco-thumb-big-@retina',
							'chocorocco-thumb-med',
							'chocorocco-thumb-med-@retina',
                                'chocorocco-thumb-square',
                                'chocorocco-thumb-square-@retina',
							'chocorocco-thumb-tiny',
							'chocorocco-thumb-tiny-@retina',
							'chocorocco-thumb-masonry-big',
							'chocorocco-thumb-masonry-big-@retina',
							'chocorocco-thumb-masonry',
							'chocorocco-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}
?>