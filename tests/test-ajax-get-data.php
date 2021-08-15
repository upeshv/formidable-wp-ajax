<?php
/**
 * Class Test_Ajax_Get_Data 
 * 
 * @group ajax
 * 
 * @package Formidable_Wp_Ajax
 */

class Test_Ajax_Get_Data extends WP_Ajax_UnitTestCase
{

  /**
   * Setup ajax request method
   */
  public function setup()
  {

    parent::setup();

    $_SERVER['REQUEST_METHOD'] = 'GET';
  }

  /**
   * make_ajax_call helper
   *
   * @param string $action Action.
   */
  protected function make_ajax_call($action)
  {
    // Make the request.
    try {
      $this->_handleAjax($action);
    } catch (WPAjaxDieContinueException $e) {
      unset($e);
    }
  }

  /**
   * Testing successful test_ajax_data showing the expected results and also
   * making sure ajax request runs once per hour
   * 
   */
  public function test_ajax_data()
  {

    // Custom Value to match the ajax call
    $custom_data = '<table class="form-table frm-wp-ajax-table"><thead><tr valign="top"><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Date</th></tr></thead><tbody><tr valign="top"><td>12</td><td>Bob</td><td>Test</td><td>bob@test.com</td><td>August 15, 2021</td></tr><tr valign="top"><td>33</td><td>Bill</td><td>Test</td><td>bill@test.com</td><td>August 25, 2021</td></tr><tr valign="top"><td>54</td><td>Jack</td><td>Test</td><td>jack@test.com</td><td>August 30, 2021</td></tr><tr valign="top"><td>66</td><td>Chris</td><td>Test</td><td>chris@test.com</td><td>August 16, 2021</td></tr><tr valign="top"><td>92</td><td>Joe</td><td>Test</td><td>joe@test.com</td><td>August 20, 2021</td></tr></tbody></table>';

    // Custom value to check transient duration
    $transient_custom_val = '3600';

    // AJAX callback and nonce
    $_POST =  array(
      'action' => 'get_strategy_data',
      'security' => wp_create_nonce('formidable-wp-ajax-security-nonce')
    );

    $this->make_ajax_call('get_strategy_data');

    // Get the set transient timeout value.
    $expires = (int)get_option('_transient_timeout_frm_wp_ajax_strategy_data', 0);

    // Fetch the remaning time which should always be 1 hour i.e 3600.
    $time_left = $expires - time();

    // Match the requested ajax call expires time which in a way proves that the ajax call runs once in an hour.
    $this->assertEquals($transient_custom_val, $time_left);

    // Get the results.
    $response = json_decode($this->_last_response, true);

    // Condition for AJAX status
    $response['type'] = ('success' === $response['type']);

    // Check if AJAX Call to required endpoint is successful
    $this->assertTrue($response['type']);

    // Match the data with AJAX response
    $this->assertEquals($custom_data, $response['data']);
  }
}
