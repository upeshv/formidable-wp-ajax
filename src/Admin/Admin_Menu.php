<?php
/**
 * Create menu page in WP backend.
 *
 * @package Formidable WP AJAX
 */

namespace FrmWPAjax\Admin;

use FrmWPAjax\Admin\Frmwp_Logo;
use FrmWPAjax\Admin\Pages\Data_Listing;
use FrmWPAjax\Admin\Pages\Settings;
use FrmWPAjax\Admin\Admin_Notices;
use FrmWPAjax\Admin\Text_Domain;
use FrmWPAjax\Frontend\Shortcode;

/**
 * Class Admin_Menu registers the required settings for the plugin backend
 * and creates the menu page to display the data.
 *
 * @since 1.0.0
 */

if (!class_exists('Admin_Menu')) :

	class Admin_Menu
	{

		/**
		 * Construct the Admin_Menu class.
		 *
		 * @since   1.0.0
		 */

		public function __construct()
		{

			/* Hook settings add additonal info */
			add_action('admin_menu', [$this, 'frmwp_admin_menu']);

			// Plugin helper functions.
			$this->load_helpers();
		}

		/**
		 * Regsiter plugin settings page.
		 *
		 * @since   1.0.0
		 */
		public function frmwp_admin_menu()
		{

			/* Main Menu Page */
			add_menu_page(
				__('Formidable WP AJAX', 'formidable-wp-ajax'),
				__('Formidable WP AJAX', 'formidable-wp-ajax'),
				'manage_options',
				'formidable-wp-ajax',
				'', // Callback not required here
				self::menu_icon(), // Using self to access static function
				98
			);

			/** 
			 * Table Data Listing Sub Menu Page
			 * 
			 * @since   1.0.0 
			 */
			add_submenu_page(
				'formidable-wp-ajax',
				__('Data Listing', 'formidable-wp-ajax'),
				__('Data Listing', 'formidable-wp-ajax'),
				'manage_options',
				'formidable-wp-ajax',
				[$this, 'frmwp_data_table'] // Callback function
			);

			/** 
			 * Settings Sub Menu Page
			 * 
			 * @since   1.0.0
			 */
			add_submenu_page(
				'formidable-wp-ajax',
				__('Settings', 'formidable-wp-ajax'),
				__('Settings', 'formidable-wp-ajax'),
				'manage_options',
				'formidable-wp-ajax-settings',
				[$this, 'frmwp_settings'] // Callback function
			);
		}

		/** 
		 * Below is a private static callback function used to display plugin menu icon from 
		 * Frmwp_Logo class
		 * 
		 * @since   1.0.0
		 */
		private static function menu_icon()
		{
			$icon = Frmwp_Logo::svg_logo(
				array(
					'fill'   => '#a0a5aa',
					'orange' => '#a0a5aa',
				)
			);
			$icon = 'data:image/svg+xml;base64,' . base64_encode($icon);

			return $icon;
		}

		/**
		 * Helper functions required on plugin load.
		 *
		 * @since   1.0.0
		 */
		public function load_helpers()
		{

			// Register Admin Notices.
			(new Admin_Notices());

			// Load Text_Domain.
			(new Text_Domain());

			// Register Shortcode.
			(new Shortcode())->load_shortcode();
		}

		/**
		 * frmwp_data_table helps us to display content on Data Listing backend page
		 *
		 * @since   1.0.0
		 */
		public function frmwp_data_table()
		{

			// Get the data from the 'Data_Listing' class.
			(new Data_Listing())->display_data_listing_content();
		}

		/**
		 * frmwp_settings help us to create Settings Page where shortcode info is added.
		 *
		 * @since   1.0.0
		 */
		public function frmwp_settings()
		{

			// Get the data from the 'Settings' class.
			(new Settings())->display_settings_page_content();
		}
	}

endif;
