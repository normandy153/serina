<?php
/**
 * Controller
 *
 * Date: 23/12/13
 * Time: 11:26 PM
 */

namespace Core\Test\Unrestricted;

class Controller extends \App\Controller\Type\Unrestricted {

	/**
	 * Experimental method
	 */
	public function getTest() {
		$this->output('getTest', array(
			'args' => $this->getArgs(),
			'testKey' => 'testValue'
		));
	}
}