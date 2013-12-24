<?php
/**
 * Controller
 *
 * Date: 23/12/13
 * Time: 11:26 PM
 */

namespace Custom\Mort;
use \App\Controller\Payload as Payload;

class Controller extends \App\Controller\Base {

	/**
	 * Experimental method
	 */
	public function getMort() {
		echo 'getMort() ran.';

		return new Payload('getMort', array(
			'args' => $this->getArgs(),
			'mortKey' => 'testMort'
		));
	}
}