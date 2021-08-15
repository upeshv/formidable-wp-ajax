<?php
/**
 * Core plugin functionality.
 *
 * @package Formidable WP AJAX
 */

namespace FrmWPAjax;

use FrmWPAjax\Admin\Admin_Menu;
use FrmWPAjax\Admin\Settings_Link;
use FrmWPAjax\Admin\Refresh_Data;
use FrmWPAjax\Admin\Version_Check;

/**
 * main class Core
 *
 * @since 1.0.0
 */

if (!class_exists('Core')) :

  class Core
  {

    /**
     * Core constructor where all hooks are assigned.
     *
     * @since 1.0.0
     */

    public function __construct()
    {

      // Detect current page.
      global $pagenow;

      // Activation hook to be executed one time when the plugin is activated
      register_activation_hook(FRMWPAJAX_PLUGIN_FILE, [$this, 'activate']);

      // Add plugins settings link.
      (new Settings_Link());

      // Load plugin backend scripts and styles only if plugin admin page.
      if (isset($_GET['page'])) {
        // If plugin settings page.
        if (in_array($pagenow, array('admin.php')) && (($_GET['page'] == 'formidable-wp-ajax') || ($_GET['page'] == 'formidable-wp-ajax-settings'))) {

          // Admin scripts and styles
          add_action('admin_enqueue_scripts', [$this, 'admin_scripts']);
          add_action('admin_enqueue_scripts', [$this, 'admin_styles']);
        }
      }

      // Add plugin admin pages
      (new Admin_Menu());

      // Frontend scripts and styles
      add_action('wp_enqueue_scripts', [$this, 'frontend_scripts']);
      add_action('wp_enqueue_scripts', [$this, 'frontend_styles']);

      // Define Ajax.
      add_action('wp_ajax_get_strategy_data', [$this, 'get_strategy_data']);
      add_action('wp_ajax_nopriv_get_strategy_data', [$this, 'get_strategy_data']);

      // Allow async or defer on asset loading.
      add_filter('script_loader_tag', [$this, 'script_loader_tag'], 10, 2);
    }

    /**
     * Functions for registering backend scripts
     * Load JavaScript helper functions
     *
     * @since 1.0.0
     */
    public function admin_scripts()
    {

      // Registering backend js
      wp_register_script(
        __('frmwp-backend-js', 'formidable-wp-ajax'),
        FRMWPAJAX_PLUGIN_URL . 'assets/js/frmwp-backend.js',
        array('jquery'),
        FRMWPAJAX_PLUGIN_VERSION
      );

      //localizing ajax scripts url
      wp_localize_script(
        __('frmwp-backend-js', 'formidable-wp-ajax'),
        'ajax_initialize_script_frmwp',
        array(
          'ajax_url' => admin_url('admin-ajax.php'),
          'security' => wp_create_nonce('formidable-wp-ajax-security-nonce'),
        )
      );

      // jQuery is needed.
      wp_enqueue_script('jquery');

      // Enqueue Script
      wp_enqueue_script(
        __('frmwp-backend-js', 'formidable-wp-ajax')
      );
    }

    /**
     * Functions for registering backend stylesheets
     *
     * @since 1.0.0
     */
    public function admin_styles()
    {

      wp_enqueue_style(
        __('frmwp-backend-css', 'formidable-wp-ajax'),
        FRMWPAJAX_PLUGIN_URL . 'assets/css/frmwp-backend.css',
        array(),
        FRMWPAJAX_PLUGIN_VERSION,
        'all'
      );
    }

    /**
     * Functions for registering frontend scripts
     *
     * @since 1.0.0
     */
    public function frontend_scripts()
    {
      wp_enqueue_script(
        __('frmwp-frontend-js', 'formidable-wp-ajax'),
        FRMWPAJAX_PLUGIN_URL . 'assets/js/frmwp-frontend.js',
        array(),
        FRMWPAJAX_PLUGIN_VERSION
      );
    }

    /**
     * Functions for registering frontend stylesheets
     *
     * @since 1.0.0
     */
    public function frontend_styles()
    {
      wp_enqueue_style(
        __('frmwp-frontend-css', 'formidable-wp-ajax'),
        FRMWPAJAX_PLUGIN_URL . 'assets/css/frmwp-frontend.css',
        array(),
        FRMWPAJAX_PLUGIN_VERSION,
        'all'
      );
    }

    /**
     * Activate plugin actions.
     *
     * @since 1.0.0
     */
    public function activate()
    {
      /**
       * Since Plugins are already activated in a sandbox, hence checking out the WP and 
       * PHP verison check, if failed then do not activate plugin
       *
       */
      (new Version_Check())->wp_php_version_check_return();
    }

    /**
     * Ajax Callback Function plugin actions.
     *
     * @since 1.0.0
     */
    public function get_strategy_data()
    {

      // Assign refersh logic to ajax callback
      (new Refresh_Data())->get_ajax_strategy_data();
    }

    /**
     * Add async/defer attributes to enqueued scripts that have the specified 
     * script_execution flag.
     * 
     * Added for later use.
     *
     * @param string $tag    The script tag.
     * @param string $handle The script handle.
     * @return string
     * 
     * @since 1.0.0
     */
    function script_loader_tag($tag, $handle)
    {
      $script_execution = wp_scripts()->get_data($handle, 'script_execution');

      if (!$script_execution) {
        return $tag;
      }

      if ('async' !== $script_execution && 'defer' !== $script_execution) {
        return $tag; // doing_it_wrong
      }

      // Abort adding async/defer for scripts that have this script as a dependency. 
      foreach (wp_scripts()->registered as $script) {
        if (in_array($handle, $script->deps, true)) {
          return $tag;
        }
      }

      // Add the attribute if it hasn't already been added.
      if (!preg_match(":\s$script_execution(=|>|\s):", $tag)) {
        $tag = preg_replace(':(?=></script>):', " $script_execution", $tag, 1);
      }

      return $tag;
    }
  }
endif;
