<?php
/**
 * Plugin Name:       Formidable WP AJAX
 * Description:       Ability to retrieves data from remote endpoint using WP AJAX.
 * Version:           1.0.0
 * Requires at least: 4.9
 * Requires PHP:      5.6.0
 * Author:            Upesh Vishwakarma
 * Author URI:        https://github.com/upeshv/formidable-wp-ajax
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       formidable-wp-ajax
 * Domain Path:       /languages
 *
 * @package           Formidable WP AJAX
 */


// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Useful global constants.
 *
 * @since 1.0.0
 */

// Plugin version.
if (!defined('FRMWPAJAX_PLUGIN_VERSION')) {
	define('FRMWPAJAX_PLUGIN_VERSION', '1.0.0');
}

// Plugin Folder Path.
if (!defined('FRMWPAJAX_PLUGIN_PATH')) {
	define('FRMWPAJAX_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

// Plugin Folder URL.
if (!defined('FRMWPAJAX_PLUGIN_URL')) {
	define('FRMWPAJAX_PLUGIN_URL', plugin_dir_url(__FILE__));
}

// Plugin Root File.
if (!defined('FRMWPAJAX_PLUGIN_FILE')) {
	define('FRMWPAJAX_PLUGIN_FILE', __FILE__);
}

// Plugin Language Folder Path.
if (!defined('FRMWPAJAX_PLUGIN_LANG')) {
	define('FRMWPAJAX_PLUGIN_LANG', FRMWPAJAX_PLUGIN_PATH . 'languages');
}

// Minimum PHP Version
if (!defined('MIN_PHP_VER')) {
	define('MIN_PHP_VER', '5.6.0');
}

// Prefix for plugin
if (!defined('FRMWPAJAX_PREFIX')) {
	define('FRMWPAJAX_PREFIX', 'frmwp');
}

require_once __DIR__ . '/formidable-wp-ajax.php';