<?php
/**
 * Restricted
 *
 * Date: 2/01/14
 * Time: 11:12 PM
 */


namespace App\Controller;


abstract class Restricted extends Base {

	/**
	 * Hook method
	 *
	 * @return mixed|void
	 */
	protected function setup() {
		new \App\Probe('Restricted hook method.');
	}
}