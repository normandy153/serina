<?php
/**
 * Controller
 *
 * Date: 23/12/13
 * Time: 11:26 PM
 */

namespace Custom\Mort\Unrestricted;

class Controller extends \App\Controller\Base {

	/**
	 * Experimental method
	 */
	public function getMort() {
		echo 'getMort() ran.';

		$this->output('getMort', array(
			'args' => $this->getArgs(),
			'mortKey' => 'testMort'
		));
	}
}