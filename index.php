<?php
/*
Plugin Name: Simple Options Framework
Plugin URI: https://longvietweb.com/sof.html
Description: A Simple and Lightweight WordPress Option Framework for Themes and Plugins
Version: 1.0
Text Domain: sof
Domain Path: /languages
Author: CaoNguyen
Author URI: https://longvietweb.com/
*/

define('SOF_INSTALLED', true);

add_action('after_setup_theme', 'sof_load');

if(!function_exists('sof_load')) {
	function sof_load() {
		$files = array(
			'classes/class-setup.php',
			'classes/class-admin.php',
			'classes/class-metabox.php',
			'classes/class-taxonomy.php',
			'classes/class-use.php',
			'classes/class-widget.php',
			'function/functions.php',
			'demo/admin-menu.php',
			'fields/field.php',
			'fields/multiple.php',
			'fields/checkbox.php',
			'fields/color.php',
			'fields/editor.php',
			'fields/group.php',
			'fields/hidden.php',
			'fields/media.php',
			'fields/radio.php',
			'fields/select.php',
			'fields/select-post.php',
			'fields/select-terms.php',
			'fields/select-use.php',
			'fields/text.php',
			'fields/textarea.php'
		);

		foreach($files as $file) {
			require_once(plugin_dir_path(__FILE__) . $file);
		}

		SOF_Registry::$plugins_url = plugins_url(null, __FILE__);

		load_plugin_textdomain('sof', false, dirname(plugin_basename(__FILE__)) . '/languages/');

		add_action('widgets_init', array('SOF_Widget', 'add'));
		
		if(is_admin()) {
			add_action('admin_enqueue_scripts', 'sof_admin_enqueue_scripts');
		}
	}
}
?>