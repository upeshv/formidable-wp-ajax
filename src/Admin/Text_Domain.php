<?php
/**
 * Plugin Text Domain.
 *
 * @package Formidable WP AJAX
 */

namespace FrmWPAjax\Admin;

/**
 * Class Text_Domain loads the plugin text domain.
 *
 * @since 1.0.0
 */
if (!class_exists('Text_Domain')) :

	class Text_Domain
	{

		/**
		 * Constructs the Text_Domain class.
		 *
		 * @since 1.0.0
		 */
		public function __construct()
		{

			// Load plugin textdomain.
			add_action('admin_init', [$this, 'frm_wp_ajax_load_textdomain']);
		}

		/**
		 * Load plugin textdomain.
		 *
		 * @since   1.0.0
		 */
		public function frm_wp_ajax_load_textdomain()
		{

			load_plugin_textdomain('formidable-wp-ajax', false, FRMWPAJAX_PLUGIN_LANG);
		}
	}

endif;
