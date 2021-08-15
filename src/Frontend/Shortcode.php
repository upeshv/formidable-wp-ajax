<?php
/**
 * Help to display table in frontend using shortcode.
 *
 * @package Formidable WP AJAX
 */

namespace FrmWPAjax\Frontend;

// Load Get_Data class.
use FrmWPAjax\Admin\Get_Data;

/**
 * Class Shortcode adds the shortcode support to the plugin.
 *
 * @since 1.0.0
 */
if (!class_exists('Shortcode')) :

	class Shortcode
	{

		public function load_shortcode()
		{

			// Get the data from the Get_Data class.
			$get_table = new Get_Data();

			// Create shortcode to display data in frontend. [frmwpajax]
			add_shortcode('frmwpajax', [$get_table, 'display_table']);
		}
	}

endif;
