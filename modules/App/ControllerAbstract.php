<?php
/**
 * ControllerAbstract
 *
 * Date: 24/12/13
 * Time: 3:57 PM
 */


namespace App;


abstract class ControllerAbstract {

	/**
	 * A list of arguments provided in the request
	 *
	 * @var array
	 */
	protected $args = array();

	/**
	 * Constructor
	 *
	 * @param $args
	 */
	public function __construct($args) {
		$this->setArgs($args);
	}

	/* Getters/Setters
	 */

	/**
	 * Set args
	 *
	 * @param array $args
	 */
	private function setArgs($args) {
		$this->args = $args;
	}

	/**
	 * Get args
	 *
	 * @return array
	 */
	protected function getArgs() {
		return $this->args;
	}
}