<?php
/**
 * Plugin Data Listing page.
 *
 * @package Formidable WP AJAX
 */

namespace FrmWPAjax\Admin\Pages;

use FrmWPAjax\Admin\Get_Data;
use FrmWPAjax\Admin\Frmwp_Logo;

/**
 * Class Data_Listing is responsible for displaying plugins Data listing page.
 *
 * @since 1.0.0
 */

if (!class_exists('Data_Listing')) :

  class Data_Listing
  {

    /**
     * Plugins data listing page content.
     *
     * @since   1.0.0
     */
    public function display_data_listing_content()
    {
      
      // Get users data in table format.
      $users_data = (new Get_Data())->display_table();

      // Get title field from the data endpoint
      $title = (new Get_Data())->get_title();

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
              esc_attr__('_blank','formidable-wp-ajax'),
              esc_attr__('noopener','formidable-wp-ajax'),
              esc_html__('vishwa.upesh@gmail.com', 'formidable-wp-ajax')
            );
          ?>
        </div>

        <!-- Add Logo Here -->
        <div id="<?php esc_attr_e('frm-wp-ajax-header', 'formidable-wp-ajax') ?>">
          <a href="<?php echo esc_url( admin_url( 'admin.php?page=formidable-wp-ajax' ) ); ?>" aria-label="<?php esc_attr_e('Plugin Logo', 'formidable-wp-ajax') ?>" class="<?php esc_attr_e('frm-wp-ajax-header-logo', 'formidable-wp-ajax') ?>">
            <?php Frmwp_Logo::show_header_logo(); ?>
          </a>
          <span><?php esc_html_e('Formidable WP AJAX | Data Listing', 'formidable-wp-ajax'); ?></span>
        </div>
        <div id="<?php esc_attr_e('frm-wp-ajax-content-wrapper', 'formidable-wp-ajax') ?>">
          <h1></h1>
          <h2><?php esc_html_e('API Data', 'formidable-wp-ajax'); ?></h2>
          <?php
            $api_data_link = sprintf(
              '<a href="%s" aria-label="%s" target="%s" rel="%s">%s</a>',
              esc_url('https://api.strategy11.com/wp-json/challenge/v1/1'),
              esc_attr__('Endpoint url', 'formidable-wp-ajax'),
              esc_attr__('_blank', 'formidable-wp-ajax'),
              esc_attr__('noopener', 'formidable-wp-ajax'),
              esc_html__('endpoint', 'formidable-wp-ajax')
            );
          ?>
          <p><?php esc_html(_e('Below data is been fetched from this ' . $api_data_link . '.', 'formidable-wp-ajax')); ?></p>
          <table class="<?php esc_attr_e('form-table', 'formidable-wp-ajax') ?>">
            <tr valign="top">
              <th scope="row"><?php esc_html_e($title, 'formidable-wp-ajax'); ?></th>
            </tr>
            <tr>
              <td class="<?php esc_attr_e('show-content', 'formidable-wp-ajax') ?>">
                <?php
                  echo $users_data;
                ?>
              </td>
            </tr>
          </table>
        </div>

        <div id="<?php esc_attr_e('frm-wp-ajax-footer', 'formidable-wp-ajax') ?>">
          <p class="<?php esc_attr_e('notice notice-info', 'formidable-wp-ajax') ?>">
            <?php esc_html(_e('<b>Note:</b> If incase you want to override the default one hour limit, then click on below <b>"Refresh Data"</b> button to fetch new data.', 'formidable-wp-ajax')); ?>
          </p>

          <?php
            $other_attributes = array('id' => esc_attr('get-ajax-data','formidable-wp-ajax'), 'title' => esc_attr('Click Refresh data button to override one hour limit and fetch new data.','formidable-wp-ajax'));

            submit_button(__('Refresh Data', 'formidable-wp-ajax'), 'primary get-ajax-data', '', true, $other_attributes);
          ?>
        </div>

      </div>

    <?php


  }
}
endif;
