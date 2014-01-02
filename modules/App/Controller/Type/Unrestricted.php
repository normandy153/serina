<?php
/**
 * Unrestricted
 *
 * Date: 2/01/14
 * Time: 11:12 PM
 */


namespace App\Controller\Type;


abstract class Unrestricted extends Base {

	/**
	 * Hook method
	 *
	 * @return mixed|void
	 */
	protected function setup() {
		new \App\Probe('Unrestricted hook method.');
	}
}