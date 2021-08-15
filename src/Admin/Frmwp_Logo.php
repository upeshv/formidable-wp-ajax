<?php
/**
 * Formidable Logo.
 *
 * @package Formidable WP AJAX
 */

namespace FrmWPAjax\Admin;

/**
 * Frmwp_Logo Class help us to list down all the logos which is used across the plugin
 *
 * @since 1.0.0
 */

if (!class_exists('Frmwp_Logo')) :

  class Frmwp_Logo
  {

    /**
     * svg_logo common class to generate plugin logo.
     *
     * @since 1.0.0
     */
    public static function svg_logo($atts = array())
    {
      $defaults = array(
        'height' => 18,
        'width'  => 18,
        'fill'   => '#4d4d4d',
        'orange' => '#f05a24',
      );
      $atts     = array_merge($defaults, $atts);

      return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 599.68 601.37" width="' . esc_attr($atts['width']) . '" height="' . esc_attr($atts['height']) . '">
        <path fill="' . esc_attr($atts['orange']) . '" d="M289.6 384h140v76h-140z"/>
        <path fill="' . esc_attr($atts['fill']) . '" d="M400.2 147h-200c-17 0-30.6 12.2-30.6 29.3V218h260v-71zM397.9 264H169.6v196h75V340H398a32.2 32.2 0 0 0 30.1-21.4 24.3 24.3 0 0 0 1.7-8.7V264zM299.8 601.4A300.3 300.3 0 0 1 0 300.7a299.8 299.8 0 1 1 511.9 212.6 297.4 297.4 0 0 1-212 88zm0-563A262 262 0 0 0 38.3 300.7a261.6 261.6 0 1 0 446.5-185.5 259.5 259.5 0 0 0-185-76.8z"/>
      </svg>';
    }

    /**
     * Filters text content and strips out disallowed HTML and helps us to show logo
     * 
     * @since 1.0.0
     */
    public static function show_logo($atts = array())
    {
      echo self::kses(self::svg_logo($atts), 'all');
    }

    /**
     * Display Plugin Header Logo
     * 
     * @since 1.0.0
     */
    public static function show_header_logo()
    {
      $icon = self::svg_logo(
        array(
          'height' => 35,
          'width'  => 35,
        )
      );

      $new_icon = apply_filters('frm_icon', $icon, true);
      if ($new_icon !== $icon) {
        if (strpos($new_icon, '<svg') === 0) {
          $icon = str_replace('viewBox="0 0 20', 'width="30" height="35" style="color:#929699" viewBox="0 0 20', $new_icon);
        } else {
          // Show nothing if it isn't an SVG.
          $icon = '<div style="height:39px"></div>';
        }
      }
      echo $icon; // WPCS: XSS ok.
    }
  }
endif;
