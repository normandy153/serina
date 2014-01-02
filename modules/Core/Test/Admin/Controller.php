<?php
/**
 * Controller
 *
 * Date: 23/12/13
 * Time: 11:26 PM
 */

namespace Core\Test\Admin;

class Controller extends \App\Controller\Type\Admin {

	/**
	 * Experimental method
	 */
	public function getTest() {
		echo 'getTest() ran.';

		$this->output('getTest', array(
			'args' => $this->getArgs(),
			'testKey' => 'testValue'
		));
	}
}