<?php
/**
 * Controller
 *
 * Date: 23/12/13
 * Time: 11:26 PM
 */

namespace Core\Test\Restricted;

class Controller extends \App\Controller\Type\Restricted {

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