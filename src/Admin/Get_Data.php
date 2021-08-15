<?php
/**
 * It help us to fetch Data using AJAX Call.
 *
 * @package Formidable WP AJAX
 */

namespace FrmWPAjax\Admin;

/**
 * Class Get_Data is responsible for fetching data from the endpoint and displaying
 * it in a table format.
 *
 * @since 1.0.0
 */
if (!class_exists('Get_Data')) :

	class Get_Data
	{

		/**
		 * Data endpoint.
		 *
		 * @var Endpoint $endpoint
		 * @since   1.0.0
		 */
		protected $endpoint = 'https://api.strategy11.com/wp-json/challenge/v1/1';

		/**
		 * Formats the fetched data in table format.
		 *
		 * @var Endpoint $endpoint
		 * @since   1.0.0
		 */
		public function display_table()
		{

			// Get any existing copy of our transient data.
			if (false === ($response = get_transient('frm_wp_ajax_strategy_data'))) {

				// Transient expired, refresh the data.
				$response        = wp_remote_get($this->endpoint);
				$this->http_code = wp_remote_retrieve_response_code($response);

				// If response code is 200 then set the transient data for 1 hour.
				if ($this->http_code == 200) :
					set_transient('frm_wp_ajax_strategy_data', $response, 60 * 60);
				endif;
			}

			if ($response['response']['code'] == 200) : // if response is OK.

				$data = (json_decode(wp_remote_retrieve_body($response), true));

				$headers = $data['data']['headers'];
				$users   = $data['data']['rows'];

				// Setup display data.
				$result  = '<table class="' . esc_attr__('form-table frm-wp-ajax-table', 'formidable-wp-ajax') . '">';
				$result .= '<thead>';
				$result .= '<tr valign="' . esc_attr__('top', 'formidable-wp-ajax') . '">';
				foreach ($headers as $header) {
					$result .= '<th>' . esc_attr($header) . '</th>';
				}
				$result .= '</tr>';
				$result .= '</thead>';
				$result .= '<tbody>';

				/**
				 * Sort result based on ID
				 *
				 * @param int $a
				 * @param int $b
				 * @return int greater number
				 */
				function cmp($a, $b)
				{
					if ($a == $b) {
						return 0;
					}
					return ($a < $b) ? -1 : 1;
				}

				// Namespace added for cmp function.
				usort($users, 'FrmWPAjax\Admin\cmp');
				foreach ($users as $user) {
					$result .= '<tr valign="' . esc_attr__('top', 'formidable-wp-ajax') . '">';
					$result .= '<td>' . esc_attr__($user['id'], 'formidable-wp-ajax') . '</td>';
					$result .= '<td>' . esc_attr__($user['fname'], 'formidable-wp-ajax') . '</td>';
					$result .= '<td>' . esc_attr__($user['lname'], 'formidable-wp-ajax') . '</td>';
					$result .= '<td>' . esc_attr__($user['email'], 'formidable-wp-ajax') . '</td>';
					$result .= '<td>' . esc_attr__(date_i18n('F d, Y', $user['date']), 'formidable-wp-ajax') . '</td>';
					$result .= '</tr>';
				}

				$result .= '</tbody>';
				$result .= '</table>';
				return $result;

			endif;
		}

		/**
		 * Get title value from the given endpoint
		 *
		 * @since   1.0.0
		 *
		 * @return string title
		 */

		public function get_title()
		{
			$response = get_transient('frm_wp_ajax_strategy_data');
			if ($response) {
				return json_decode(wp_remote_retrieve_body($response), true)['title'];
			}
		}

		/**
		 * Getter Function to get the endpoint value outside the class.
		 * 
		 * @since   1.0.0
		 */
		public function getEndpoint()
		{
			return $this->endpoint;
		}
	}

endif;
