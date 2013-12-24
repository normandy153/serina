<?php
/**
 * Controller
 *
 * Date: 23/12/13
 * Time: 11:26 PM
 */

namespace Core\Test;

class Controller extends \App\ControllerAbstract {

	/**
	 * Experimental method
	 */
	public function getTest() {
		echo 'getTest() ran.';
		new \App\Probe($this->getArgs());
	}
}