<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('chocorocco_storage_get')) {
	function chocorocco_storage_get($var_name, $default='') {
		global $CHOCOROCCO_STORAGE;
		return isset($CHOCOROCCO_STORAGE[$var_name]) ? $CHOCOROCCO_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('chocorocco_storage_set')) {
	function chocorocco_storage_set($var_name, $value) {
		global $CHOCOROCCO_STORAGE;
		$CHOCOROCCO_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('chocorocco_storage_empty')) {
	function chocorocco_storage_empty($var_name, $key='', $key2='') {
		global $CHOCOROCCO_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($CHOCOROCCO_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($CHOCOROCCO_STORAGE[$var_name][$key]);
		else
			return empty($CHOCOROCCO_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('chocorocco_storage_isset')) {
	function chocorocco_storage_isset($var_name, $key='', $key2='') {
		global $CHOCOROCCO_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($CHOCOROCCO_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($CHOCOROCCO_STORAGE[$var_name][$key]);
		else
			return isset($CHOCOROCCO_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('chocorocco_storage_inc')) {
	function chocorocco_storage_inc($var_name, $value=1) {
		global $CHOCOROCCO_STORAGE;
		if (empty($CHOCOROCCO_STORAGE[$var_name])) $CHOCOROCCO_STORAGE[$var_name] = 0;
		$CHOCOROCCO_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('chocorocco_storage_concat')) {
	function chocorocco_storage_concat($var_name, $value) {
		global $CHOCOROCCO_STORAGE;
		if (empty($CHOCOROCCO_STORAGE[$var_name])) $CHOCOROCCO_STORAGE[$var_name] = '';
		$CHOCOROCCO_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('chocorocco_storage_get_array')) {
	function chocorocco_storage_get_array($var_name, $key, $key2='', $default='') {
		global $CHOCOROCCO_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($CHOCOROCCO_STORAGE[$var_name][$key]) ? $CHOCOROCCO_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($CHOCOROCCO_STORAGE[$var_name][$key][$key2]) ? $CHOCOROCCO_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('chocorocco_storage_set_array')) {
	function chocorocco_storage_set_array($var_name, $key, $value) {
		global $CHOCOROCCO_STORAGE;
		if (!isset($CHOCOROCCO_STORAGE[$var_name])) $CHOCOROCCO_STORAGE[$var_name] = array();
		if ($key==='')
			$CHOCOROCCO_STORAGE[$var_name][] = $value;
		else
			$CHOCOROCCO_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('chocorocco_storage_set_array2')) {
	function chocorocco_storage_set_array2($var_name, $key, $key2, $value) {
		global $CHOCOROCCO_STORAGE;
		if (!isset($CHOCOROCCO_STORAGE[$var_name])) $CHOCOROCCO_STORAGE[$var_name] = array();
		if (!isset($CHOCOROCCO_STORAGE[$var_name][$key])) $CHOCOROCCO_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$CHOCOROCCO_STORAGE[$var_name][$key][] = $value;
		else
			$CHOCOROCCO_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('chocorocco_storage_merge_array')) {
	function chocorocco_storage_merge_array($var_name, $key, $value) {
		global $CHOCOROCCO_STORAGE;
		if (!isset($CHOCOROCCO_STORAGE[$var_name])) $CHOCOROCCO_STORAGE[$var_name] = array();
		if ($key==='')
			$CHOCOROCCO_STORAGE[$var_name] = array_merge($CHOCOROCCO_STORAGE[$var_name], $value);
		else
			$CHOCOROCCO_STORAGE[$var_name][$key] = array_merge($CHOCOROCCO_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('chocorocco_storage_set_array_after')) {
	function chocorocco_storage_set_array_after($var_name, $after, $key, $value='') {
		global $CHOCOROCCO_STORAGE;
		if (!isset($CHOCOROCCO_STORAGE[$var_name])) $CHOCOROCCO_STORAGE[$var_name] = array();
		if (is_array($key))
			chocorocco_array_insert_after($CHOCOROCCO_STORAGE[$var_name], $after, $key);
		else
			chocorocco_array_insert_after($CHOCOROCCO_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('chocorocco_storage_set_array_before')) {
	function chocorocco_storage_set_array_before($var_name, $before, $key, $value='') {
		global $CHOCOROCCO_STORAGE;
		if (!isset($CHOCOROCCO_STORAGE[$var_name])) $CHOCOROCCO_STORAGE[$var_name] = array();
		if (is_array($key))
			chocorocco_array_insert_before($CHOCOROCCO_STORAGE[$var_name], $before, $key);
		else
			chocorocco_array_insert_before($CHOCOROCCO_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('chocorocco_storage_push_array')) {
	function chocorocco_storage_push_array($var_name, $key, $value) {
		global $CHOCOROCCO_STORAGE;
		if (!isset($CHOCOROCCO_STORAGE[$var_name])) $CHOCOROCCO_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($CHOCOROCCO_STORAGE[$var_name], $value);
		else {
			if (!isset($CHOCOROCCO_STORAGE[$var_name][$key])) $CHOCOROCCO_STORAGE[$var_name][$key] = array();
			array_push($CHOCOROCCO_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('chocorocco_storage_pop_array')) {
	function chocorocco_storage_pop_array($var_name, $key='', $defa='') {
		global $CHOCOROCCO_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($CHOCOROCCO_STORAGE[$var_name]) && is_array($CHOCOROCCO_STORAGE[$var_name]) && count($CHOCOROCCO_STORAGE[$var_name]) > 0) 
				$rez = array_pop($CHOCOROCCO_STORAGE[$var_name]);
		} else {
			if (isset($CHOCOROCCO_STORAGE[$var_name][$key]) && is_array($CHOCOROCCO_STORAGE[$var_name][$key]) && count($CHOCOROCCO_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($CHOCOROCCO_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('chocorocco_storage_inc_array')) {
	function chocorocco_storage_inc_array($var_name, $key, $value=1) {
		global $CHOCOROCCO_STORAGE;
		if (!isset($CHOCOROCCO_STORAGE[$var_name])) $CHOCOROCCO_STORAGE[$var_name] = array();
		if (empty($CHOCOROCCO_STORAGE[$var_name][$key])) $CHOCOROCCO_STORAGE[$var_name][$key] = 0;
		$CHOCOROCCO_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('chocorocco_storage_concat_array')) {
	function chocorocco_storage_concat_array($var_name, $key, $value) {
		global $CHOCOROCCO_STORAGE;
		if (!isset($CHOCOROCCO_STORAGE[$var_name])) $CHOCOROCCO_STORAGE[$var_name] = array();
		if (empty($CHOCOROCCO_STORAGE[$var_name][$key])) $CHOCOROCCO_STORAGE[$var_name][$key] = '';
		$CHOCOROCCO_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('chocorocco_storage_call_obj_method')) {
	function chocorocco_storage_call_obj_method($var_name, $method, $param=null) {
		global $CHOCOROCCO_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($CHOCOROCCO_STORAGE[$var_name]) ? $CHOCOROCCO_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($CHOCOROCCO_STORAGE[$var_name]) ? $CHOCOROCCO_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('chocorocco_storage_get_obj_property')) {
	function chocorocco_storage_get_obj_property($var_name, $prop, $default='') {
		global $CHOCOROCCO_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($CHOCOROCCO_STORAGE[$var_name]->$prop) ? $CHOCOROCCO_STORAGE[$var_name]->$prop : $default;
	}
}
?>