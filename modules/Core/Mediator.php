<?php
/**
 * Mediator
 *
 * Date: 23/12/13
 * Time: 10:12 PM
 */


namespace Core;


class Mediator {

	/**
	 * An instance of Request
	 *
	 * @var null
	 */
	private $request = null;

	/**
	 * Constructor
	 *
	 * @param $request
	 */
	public function __construct($request) {
		$this->setRequest($request);
	}

	/* Getters/Setters
	 */

	/**
	 * Set request
	 *
	 * @param null $request
	 */
	private function setRequest($request) {
		$this->request = $request;
	}

	/**
	 * Get request
	 *
	 * @return null
	 */
	private function getRequest() {
		return $this->request;
	}
}