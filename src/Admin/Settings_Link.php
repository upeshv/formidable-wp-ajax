<?php
/**
 * Plugin Settings Link functionality.
 *
 * @package Formidable WP AJAX
 */

namespace FrmWPAjax\Admin;

/**
 * Class Settings_Link is responsible for displaying plugins settings link.
 *
 * @since 1.0.0
 */

if (!class_exists('Settings_Link')) :

  class Settings_Link
  {

    // Plugin name.
    protected $plugin_name;

    /**
     * Construct the Settings_Link class.
     *
     * @since   1.0.0
     */
    public function __construct()
    {

      $this->plugin_name = plugin_basename(FRMWPAJAX_PLUGIN_FILE);

      add_filter("plugin_action_links_$this->plugin_name", [$this, 'frmwp_settings_link']);
    }

    /**
     * Add plugins settings link.
     *
     * @since   1.0.0
     */
    public function frmwp_settings_link($links)
    {

      $settings_link = sprintf(
        '<a href="%s" aria-label="%s">%s</a>',
        esc_url(admin_url('admin.php?page=formidable-wp-ajax')),
        esc_attr__('Go to Formidable WP Ajax main page', 'formidable-wp-ajax'),
        esc_html__('Settings', 'formidable-wp-ajax')
      );

      array_unshift($links, $settings_link);

      return $links;
    }
  }
endif;
