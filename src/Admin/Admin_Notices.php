<?php
/**
 * All Alert/Notices is been managed from here.
 *
 * @package Formidable WP AJAX
 */

namespace FrmWPAjax\Admin;

/**
 * Class Admin_Notice is responsible for displaying the notices on the plugin menu page.
 *
 * @since 1.0.0
 */
if (!class_exists('Admin_Notices')) :

	class Admin_Notices
	{

		/**
		 * Construct the Admin_Notices class.
		 *
		 * @since   1.0.0
		 */
		public function __construct()
		{
			// Detect current page.
			global $pagenow;

			// Show admin notices.
			if (isset($_GET['page'])) {
				// If plugin backend page.
				if (in_array($pagenow, array('admin.php')) && ($_GET['page'] == 'formidable-wp-ajax')) {
					if (get_transient('frm_wp_ajax_strategy_data')) {
						add_action('admin_notices', [$this, 'show_notice_success']);
					} else {
						add_action('admin_notices', [$this, 'show_notice_info']);
					}
				}
			}
		}

		/**
		 * Show success admin notice
		 *
		 * @since   1.0.0
		 */
		public function show_notice_success()
		{
			$notice = '<div class="' . esc_attr__('notice notice-success is-dismissible', 'formidable-wp-ajax') . '">';

			$notice .= '<p>' . sprintf(
				wp_kses( /* translators: %s - Refresh Data  anchor link. */
					__('The below data is fetched from cache and will get expired and fetch new data at every one hour!', 'formidable-wp-ajax'),
					array(
						'a'      => array(
							'href'  => array(),
							'class' => array(),
						),
						'strong' => array(),
					)
				),
				'javascript:void(0)'
			) . '</p>';

			$notice .= '</div>';

			echo $notice;
		}

		/**
		 * Show info admin notice
		 *
		 * @since   1.0.0
		 */
		public function show_notice_info()
		{

			$notice = '<div class="' . esc_attr__('notice notice-info is-dismissible', 'formidable-wp-ajax') . '">';

			$notice .= '<p>' . sprintf(
				wp_kses( /* translators: %s - Refresh Data  anchor link. */
					__('The cache got expired and new data was fetched after an interval of one hour!', 'formidable-wp-ajax'),
					array(
						'a'      => array(
							'href'  => array(),
							'class' => array(),
						),
						'strong' => array(),
					)
				),
				'javascript:void(0)'
			) . '</p>';
			$notice .= '</div>';

			echo $notice;
		}
	}

endif;
