<?php
/**
 * Plugin Settings page
 *
 * @package Formidable WP AJAX
 */

namespace FrmWPAjax\Admin\Pages;

use FrmWPAjax\Admin\Frmwp_Logo;

/**
 * Class Settings helps us to understand the form Data Listing in frontend shortcode
 *
 * @since 1.0.0
 */

if (!class_exists('Settings')) :

  class Settings
  {

    /**
     * Form API page Contents.
     *
     * @since   1.0.0
     */
    public function display_settings_page_content()
    {
      ?>

    <div class="<?php esc_attr_e('wrap frm-wp-ajax-main_wrapper', 'formidable-wp-ajax') ?>">

      <!-- Plugin top bar -->
      <div class="<?php esc_attr_e('frm-wp-ajax-bar', 'formidable-wp-ajax') ?>">
        <span><?php esc_html_e("You're using Formidable WP AJAX. If you have any doubt please reach out to", 'formidable-wp-ajax'); ?></span>
        <?php
          echo sprintf(
            '<a href="%s" aria-label="%s" target="%s" rel="%s">%s</a>',
            esc_url('mailto:vishwa.upesh@gmail.com'),
            esc_attr__('If you have any doubt please reach out to vishwa.upesh@gmail.com', 'formidable-wp-ajax'),
            esc_attr__('_blank', 'formidable-wp-ajax'),
            esc_attr__('noopener', 'formidable-wp-ajax'),
            esc_html__('vishwa.upesh@gmail.com', 'formidable-wp-ajax')
          );
        ?>
      </div>

      <!-- Add Logo Here -->
      <div id="<?php esc_attr_e('frm-wp-ajax-header', 'formidable-wp-ajax') ?>">
        <a href="<?php echo esc_url(admin_url('admin.php?page=formidable-wp-ajax')); ?>" aria-label="<?php esc_attr_e('Plugin Logo', 'formidable-wp-ajax') ?>" class="<?php esc_attr_e('frm-wp-ajax-header-logo', 'formidable-wp-ajax') ?>">
          <?php Frmwp_Logo::show_header_logo(); ?>
        </a>
        <span><?php esc_html_e('Formidable WP AJAX | Settings', 'formidable-wp-ajax'); ?></span>
      </div>

      <div id="<?php esc_attr_e('frm-wp-ajax-content-wrapper', 'formidable-wp-ajax') ?>">
        <div class="<?php esc_attr_e('frm-block', 'formidable-wp-ajax') ?>">
          <h3><?php esc_html_e("Shortcode Details", 'formidable-wp-ajax') ?></h3>
          <p><?php esc_html_e("To display the endpoint table data in frontend please use below shortcode.", 'formidable-wp-ajax') ?></p>
          <p><b><code><?php esc_html_e("[frmwpajax]", 'formidable-wp-ajax') ?></code></b></p>
        </div>
      </div>

      <?php
    }
  }

endif;
