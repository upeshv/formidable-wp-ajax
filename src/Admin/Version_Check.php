<?php
/**
 * WP and PHP Version check.
 *
 * @package Formidable WP AJAX
 */

namespace FrmWPAjax\Admin;

/**
 * Class Version_Check helps us to detect the client WP and PHP version and notifcation if 
 * lower version is runnning.
 *
 * @since 1.0.0
 */

if (!class_exists('Version_Check')) :

  class Version_Check
  {

    /**
     * Add plugins version check .
     *
     * @since   1.0.0
     */
    public function wp_php_version_check_return($wp = '4.9', $php = '5.6.0')
    {

      //Get wp version helper
      global $wp_version;

      if (version_compare($wp_version, $wp, '<=')) // WP Version Check
        $flag = 'WordPress';
      elseif (version_compare(phpversion(), $php, '<=')) // PHP Version Check
        $flag = 'PHP';
      else
        return;

      $version = 'PHP' == $flag ? $php : $wp;

      // Forcefully Deactivate plugin if above check failed
      deactivate_plugins(basename(__FILE__));

      // Error message with WP Die function
      wp_die(esc_html(_e('<p>The <strong>Formidable WP AJAX</strong> plugin requires ' . $flag . '  version ' . $version . ' or greater.</p>', 'formidable-wp-ajax')), 'Plugin Activation Error',  array('response' => 200, 'back_link' => TRUE));
    }
  }
endif;
