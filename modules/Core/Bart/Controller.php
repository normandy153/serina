<?php
/**
 * Controller
 *
 * Date: 23/12/13
 * Time: 11:26 PM
 */

namespace Core\Bart;

class Controller extends \App\Controller\Base {

	/**
	 * Experimental method
	 */
	public function getBart() {
		echo 'getBart() ran.';

		$this->output('getTest', array(
			'args' => $this->getArgs(),
			'testKey' => 'bart test'
		));
	}
}