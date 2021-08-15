<?php
/**
 * It will help us to refersh ajax data upon request.
 *
 * @package Formidable WP AJAX
 */

namespace FrmWPAjax\Admin;

use FrmWPAjax\Admin\Get_Data;

/**
 * Class Refresh_Data gets the data from the endpoint on action of the button click.
 *
 * @since 1.0.0
 */
if (!class_exists('Refresh_Data')) :

	class Refresh_Data
	{

		/**
		 * Function called on "Refresh Data" button clicked via Ajax
		 *
		 * @since   1.0.0
		 */
		public function get_ajax_strategy_data()
		{

			// Nonce Check.
			if ('GET' === $_SERVER['REQUEST_METHOD']) { // Check if get method.

				// Checking any unauthorized requests and blocking it.
				if (!check_ajax_referer('formidable-wp-ajax-security-nonce', 'security', false)) {

					// Send an error if the token mismatch
					wp_send_json_error('Invalid security token sent.');
					wp_die();
				}
			}

			/**
			 * Delete the transient cache if refresh data button is pressed.
			 */
			delete_transient('frm_wp_ajax_strategy_data');

			// get the data in table format.
			$table_response = (new Get_Data())->display_table();

			// array of repsonse data
			$data_response = array(
				'type' => 'success',
				'data' => $table_response,
			);

			// send data back to the calling script in decoded format.
			echo json_encode($data_response);
			wp_die();
		}
	}

endif;
