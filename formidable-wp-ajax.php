<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Do not want to load a complete set of files hence seprating it from default Composer autoloader.
 *
 * @since 1.0.0
 *
 * @param string $class
 */
spl_autoload_register(function ($class) {

	list($plugin_space) = explode('\\', $class);
	if ($plugin_space !== 'FrmWPAjax') {
		return;
	}

	/*
	 * Base folder directory
	 */
	$plugin_dir = basename(__DIR__);

	// Default directory plugin's /src/.
	$base_dir = plugin_dir_path(__DIR__) . '/' . $plugin_dir . '/src/';

	// Get the relative class name.
	$relative_class = substr($class, strlen($plugin_space) + 1);

	// Prepare a path to a file.
	$file = wp_normalize_path($base_dir . $relative_class . '.php');

	// If the file exists, require it.
	if (is_readable($file)) {
		require_once $file;
	}
});

/**
 * Global function-holder. Works similar to a singleton's instance().
 *
 * @since 1.0.0
 *
 * @return FrmWPAjax\Core
 */
function formidable_wp_ajax()
{
	/**
	 * @var \FrmWPAjax\Core
	 */
	static $core;

	if (!isset($core)) {
		$core = new \FrmWPAjax\Core();
	}

	return $core;
}

formidable_wp_ajax();



// Namespace to fetch specific Data for perparing WPCLI command.
use FrmWPAjax\Admin\Get_Data;

/**
 * WP-CLI Command to get new data
 * source ~/.bash_profile
 * wp frm-wp-ajax-reset
 * 
 * @since   1.0.0
 */

$cli = function () {
	// This function can only be accessed via CLI.
	if (!defined('WP_CLI')) {
		return;
	}

	// Delete the saved transient data.
	delete_transient('frm_wp_ajax_strategy_data');

	// Fetch new data from the endpoint.
	$get_new_data = (new Get_Data());
	$get_new_data->display_table();

	WP_CLI::success('Congratulations new data have been fetched please refresh your page to see the new data! Endpoint: ' . esc_url($get_new_data->getEndpoint()) . '');
};

/**
 * Add's the WP_CLI command to fetch new data.
 *
 * @since   1.0.0
 */
if (class_exists('WP_CLI')) { // execute only if ran via command line.
	if (is_admin() || (defined('WP_CLI') && WP_CLI)) {
		WP_CLI::add_command('frm-wp-ajax-reset', $cli);
	}
}
