<?php
/**
 * Theme lists
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }



// Return numbers range
if ( !function_exists( 'chocorocco_get_list_range' ) ) {
	function chocorocco_get_list_range($from=1, $to=2, $prepend_inherit=false) {
		$list = array();
		for ($i=$from; $i<=$to; $i++)
			$list[$i] = $i;
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}



// Return styles list
if ( !function_exists( 'chocorocco_get_list_styles' ) ) {
	function chocorocco_get_list_styles($from=1, $to=2, $prepend_inherit=false) {
		$list = array();
		for ($i=$from; $i<=$to; $i++)
			$list[$i] = sprintf(esc_html__('Style %d', 'chocorocco'), $i);
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}

// Return list with 'Yes' and 'No' items
if ( !function_exists( 'chocorocco_get_list_yesno' ) ) {
	function chocorocco_get_list_yesno($prepend_inherit=false) {
		$list = array(
			"yes"	=> esc_html__("Yes", 'chocorocco'),
			"no"	=> esc_html__("No", 'chocorocco')
		);
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}

// Return list with 'On' and 'Of' items
if ( !function_exists( 'chocorocco_get_list_onoff' ) ) {
	function chocorocco_get_list_onoff($prepend_inherit=false) {
		$list = array(
			"on"	=> esc_html__("On", 'chocorocco'),
			"off"	=> esc_html__("Off", 'chocorocco')
		);
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}

// Return list with 'Show' and 'Hide' items
if ( !function_exists( 'chocorocco_get_list_showhide' ) ) {
	function chocorocco_get_list_showhide($prepend_inherit=false) {
		$list = array(
			"show" => esc_html__("Show", 'chocorocco'),
			"hide" => esc_html__("Hide", 'chocorocco')
		);
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}

// Return list with 'Horizontal' and 'Vertical' items
if ( !function_exists( 'chocorocco_get_list_directions' ) ) {
	function chocorocco_get_list_directions($prepend_inherit=false) {
		$list = array(
			"horizontal" => esc_html__("Horizontal", 'chocorocco'),
			"vertical"   => esc_html__("Vertical", 'chocorocco')
		);
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}

// Return custom sidebars list, prepended inherit and main sidebars item (if need)
if ( !function_exists( 'chocorocco_get_list_sidebars' ) ) {
	function chocorocco_get_list_sidebars($prepend_inherit=false, $add_hide=false) {
		if (($list = chocorocco_storage_get('list_sidebars'))=='') {
			global $wp_registered_sidebars;
			$list = array();
			if (is_array($wp_registered_sidebars)) {
				foreach ( $wp_registered_sidebars as $k => $v ) {
					$list[$v['id']] = $v['name'];
				}
			}
			chocorocco_storage_set('list_sidebars', $list);
		}
		if ($add_hide) $list = chocorocco_array_merge(array('hide' => esc_html__("- Select widgets -", 'chocorocco')), $list);
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}

// Return sidebars positions
if ( !function_exists( 'chocorocco_get_list_sidebars_positions' ) ) {
	function chocorocco_get_list_sidebars_positions($prepend_inherit=false) {
		$list = array(
			'left'  => esc_html__('Left',  'chocorocco'),
			'right' => esc_html__('Right', 'chocorocco')
		);
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}

// Return header styles
if ( !function_exists( 'chocorocco_get_list_header_styles' ) ) {
	function chocorocco_get_list_header_styles($prepend_inherit=false) {
		static $list = false;
		if (!$list) {
			$list = apply_filters('chocorocco_filter_list_header_styles', array(
																		'header-default' => esc_html__('Default Header', 'chocorocco')
																		)
								);
		}
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}

// Return header positions
if ( !function_exists( 'chocorocco_get_list_header_positions' ) ) {
	function chocorocco_get_list_header_positions($prepend_inherit=false) {
		$list = array(
			'default' => esc_html__('Default','chocorocco'),
			'over' => esc_html__('Over',	'chocorocco'),
			'under' => esc_html__('Under',	'chocorocco')
		);
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}

// Return footer styles
if ( !function_exists( 'chocorocco_get_list_footer_styles' ) ) {
	function chocorocco_get_list_footer_styles($prepend_inherit=false) {
		static $list = false;
		if (!$list) {
			$list = apply_filters('chocorocco_filter_list_footer_styles', array(
																		'footer-default' => esc_html__('Default Footer', 'chocorocco')
																		)
								);
		}
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}

// Return blog styles list, prepended inherit
if ( !function_exists( 'chocorocco_get_list_blog_styles' ) ) {
	function chocorocco_get_list_blog_styles($prepend_inherit=false) {
		$list = apply_filters('chocorocco_filter_list_blog_styles', array(
			'excerpt'	=> esc_html__('Excerpt','chocorocco'),
			'classic_2'	=> esc_html__('Classic /2 columns/',	'chocorocco'),
			'classic_3'	=> esc_html__('Classic /3 columns/',	'chocorocco'),
			'masonry_2'	=> esc_html__('Masonry /2 columns/',	'chocorocco'),
			'masonry_3'	=> esc_html__('Masonry /3 columns/',	'chocorocco'),
			'portfolio_2' => esc_html__('Portfolio /2 columns/','chocorocco'),
			'portfolio_3' => esc_html__('Portfolio /3 columns/','chocorocco'),
			'portfolio_4' => esc_html__('Portfolio /4 columns/','chocorocco'),
			'gallery_2' => esc_html__('Gallery /2 columns/',	'chocorocco'),
			'gallery_3' => esc_html__('Gallery /3 columns/',	'chocorocco'),
			'gallery_4' => esc_html__('Gallery /4 columns/',	'chocorocco'),
			'chess_1'	=> esc_html__('Chess /2 column/',		'chocorocco'),
			'chess_2'	=> esc_html__('Chess /4 columns/',		'chocorocco'),
			'chess_3'	=> esc_html__('Chess /6 columns/',		'chocorocco')
			)
		);
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}


// Return list of categories
if ( !function_exists( 'chocorocco_get_list_categories' ) ) {
	function chocorocco_get_list_categories($prepend_inherit=false) {
		if (($list = chocorocco_storage_get('list_categories'))=='') {
			$list = array();
			$taxonomies = get_categories( array(
											'type' => 'post',
											'orderby' => 'name',
											'order' => 'ASC',
											'hide_empty' => 0,
											'hierarchical' => 1,
											'taxonomy' => 'category',
											'pad_counts' => false
											)
										);
			if (is_array($taxonomies) && count($taxonomies) > 0) {
				foreach ($taxonomies as $cat) {
					$list[$cat->term_id] = $cat->name;
				}
			}
			chocorocco_storage_set('list_categories', $list);
		}
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}


// Return list of taxonomies
if ( !function_exists( 'chocorocco_get_list_terms' ) ) {
	function chocorocco_get_list_terms($prepend_inherit=false, $taxonomy='category') {
		if (($list = chocorocco_storage_get('list_taxonomies_'.($taxonomy)))=='') {
			$list = array();
			$taxonomies = get_terms( $taxonomy, array(
													'orderby' => 'name',
													'order' => 'ASC',
													'hide_empty' => 0,
													'hierarchical' => 1,
													'taxonomy' => $taxonomy,
													'pad_counts' => false 
													)
									);
			if (is_array($taxonomies) && count($taxonomies) > 0) {
				foreach ($taxonomies as $cat) {
					$list[$cat->term_id] = $cat->name;	// . ($taxonomy!='category' ? ' /'.($cat->taxonomy).'/' : '');
				}
			}
			chocorocco_storage_set('list_taxonomies_'.($taxonomy), $list);
		}
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}

// Return list of post's types
if ( !function_exists( 'chocorocco_get_list_posts_types' ) ) {
	function chocorocco_get_list_posts_types($prepend_inherit=false) {
		if (($list = chocorocco_storage_get('list_posts_types'))=='') {
			$list = apply_filters('chocorocco_filter_list_posts_types', array(
				'post' => esc_html('Post', 'chocorocco')
			));
			chocorocco_storage_set('list_posts_types', $list);
		}
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}


// Return list post items from any post type and taxonomy
if ( !function_exists( 'chocorocco_get_list_posts' ) ) {
	function chocorocco_get_list_posts($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'post_parent'		=> '',
			'taxonomy'			=> 'category',
			'taxonomy_value'	=> '',
			'meta_key'			=> '',
			'meta_value'		=> '',
			'meta_compare'		=> '',
			'posts_per_page'	=> -1,
			'orderby'			=> 'post_date',
			'order'				=> 'desc',
			'not_selected'		=> true,
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));

		$hash = 'list_posts'
				. '_' . (is_array($opt['post_type']) ? join('_', $opt['post_type']) : $opt['post_type'])
				. '_' . (is_array($opt['post_parent']) ? join('_', $opt['post_parent']) : $opt['post_parent'])
				. '_' . ($opt['taxonomy'])
				. '_' . (is_array($opt['taxonomy_value']) ? join('_', $opt['taxonomy_value']) : $opt['taxonomy_value'])
				. '_' . ($opt['meta_key'])
				. '_' . ($opt['meta_compare'])
				. '_' . ($opt['meta_value'])
				. '_' . ($opt['orderby'])
				. '_' . ($opt['order'])
				. '_' . ($opt['return'])
				. '_' . ($opt['posts_per_page']);
		if (($list = chocorocco_storage_get($hash))=='') {
			$list = array();
			if ($opt['not_selected']!==false) $list['none'] = $opt['not_selected']===true 
																				? esc_html__("- Not selected -", 'chocorocco')
																				: $opt['not_selected'];
			$args = array(
				'post_type' => $opt['post_type'],
				'post_status' => $opt['post_status'],
				'posts_per_page' => $opt['posts_per_page'],
				'ignore_sticky_posts' => true,
				'orderby'	=> $opt['orderby'],
				'order'		=> $opt['order']
			);
			if (!empty($opt['post_parent'])) {
				if (is_array($opt['post_parent']))
					$args['post_parent__in'] = $opt['post_parent'];
				else
					$args['post_parent'] = $opt['post_parent'];
			}
			if (!empty($opt['taxonomy_value'])) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $opt['taxonomy'],
						'field' => is_array($opt['taxonomy_value']) 
										? ((int) $opt['taxonomy_value'][0] > 0  ? 'term_taxonomy_id' : 'slug')
										: ((int) $opt['taxonomy_value'] > 0  ? 'term_taxonomy_id' : 'slug'),
						'terms' => is_array($opt['taxonomy_value'])
										? $opt['taxonomy_value'] 
										: ((int) $opt['taxonomy_value'] > 0 ? (int) $opt['taxonomy_value'] : $opt['taxonomy_value'] ) 
					)
				);
			}
			if (!empty($opt['meta_key'])) {
				$args['meta_key'] = $opt['meta_key'];
			}
			if (!empty($opt['meta_value'])) {
				$args['meta_value'] = $opt['meta_value'];
			}
			if (!empty($opt['meta_compare'])) {
				$args['meta_compare'] = $opt['meta_compare'];
			}
			$posts = get_posts( $args );
			if (is_array($posts) && count($posts) > 0) {
				foreach ($posts as $post) {
					$list[$opt['return']=='id' ? $post->ID : $post->post_title] = $post->post_title;
				}
			}
			chocorocco_storage_set($hash, $list);
		}
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}


// Return list of registered users
if ( !function_exists( 'chocorocco_get_list_users' ) ) {
	function chocorocco_get_list_users($prepend_inherit=false, $roles=array('administrator', 'editor', 'author', 'contributor', 'shop_manager')) {
		if (($list = chocorocco_storage_get('list_users'))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'chocorocco');
			$users = get_users( array(
									'orderby' => 'display_name',
									'order' => 'ASC'
									)
								);
			if (is_array($users) && count($users) > 0) {
				foreach ($users as $user) {
					$accept = true;
					if (is_array($user->roles)) {
						if (is_array($user->roles) && count($user->roles) > 0) {
							$accept = false;
							foreach ($user->roles as $role) {
								if (in_array($role, $roles)) {
									$accept = true;
									break;
								}
							}
						}
					}
					if ($accept) $list[$user->user_login] = $user->display_name;
				}
			}
			chocorocco_storage_set('list_users', $list);
		}
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}

// Return menus list, prepended inherit
if ( !function_exists( 'chocorocco_get_list_menus' ) ) {
	function chocorocco_get_list_menus($prepend_inherit=false) {
		if (($list = chocorocco_storage_get('list_menus'))=='') {
			$list = array();
			$list['default'] = esc_html__("Default", 'chocorocco');
			$menus = wp_get_nav_menus();
			if (is_array($menus) && count($menus) > 0) {
				foreach ($menus as $menu) {
					$list[$menu->slug] = $menu->name;
				}
			}
			chocorocco_storage_set('list_menus', $list);
		}
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}

// Return iconed classes list
if ( !function_exists( 'chocorocco_get_list_icons' ) ) {
	function chocorocco_get_list_icons($prepend_inherit=false) {
		static $list = false;
		if (!is_array($list)) 
			$list = !is_admin() ? array() : chocorocco_parse_icons_classes(chocorocco_get_file_dir("css/fontello/css/fontello-codes.css"));
		$list = chocorocco_array_merge(array('none' => 'none'), $list);
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}

// Return images list
if ( !function_exists( 'chocorocco_get_list_images' ) ) {
	function chocorocco_get_list_images($prepend_inherit=false) {
		$list = function_exists('trx_addons_get_list_files')
				? trx_addons_get_list_files('css/icons.png', 'png')
				: array();
		return $prepend_inherit ? chocorocco_array_merge(array('inherit' => esc_html__("Inherit", 'chocorocco')), $list) : $list;
	}
}
?>