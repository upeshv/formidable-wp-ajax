<?php
/**
 * Class Test_Ajax_Hook
 *
 * @package Formidable_Wp_Ajax
 */

use FrmWPAjax\Core;

/**
 * Test_Ajax_Hook help us to check wheather the ajax action is properly called or not. 
 */
class Test_Ajax_Hook extends WP_UnitTestCase
{

	/**
	 * Testing Core class for ajax action.
	 */
	public function test_construct()
	{

		$ajax_action_test = new Core();
		$is_registered = has_action('wp_ajax_get_strategy_data', [$ajax_action_test, 'get_strategy_data']);

		$is_registered = (10 === $is_registered);

		$this->assertTrue($is_registered);
	}
}
