<?php
/**
 * Request
 *
 * Date: 23/12/13
 * Time: 10:22 PM
 */


namespace Core;


class Request {

	/**
	 * Provided arguments
	 *
	 * @var array
	 */
	private $args = array();

	/**
	 * Module endpoint
	 *
	 * @var string
	 */
	private $endpoint = '';

	/**
	 * Method used in the request (GET/PUT/POST/DELETE)
	 *
	 * @var string
	 */
	private $method = '';

	/**
	 * Constructor
	 *
	 * @param $request
	 */
	public function __construct($request) {

		/* Decide args and endpoint for restful interface
		 */
		$args = explode('/', rtrim($request['route']));
		$endpoint = array_shift($args);

		$this->setArgs($args);
		$this->setEndpoint($endpoint);

		/* Check if the second argument is non-numeric, in case something
		 * special needs to happen, like file uploads: e.g. /event/upload
		 */
		if (array_key_exists(0, $this->getArgs()) && preg_match('/[0-9]+/', $args[0])) {

		}

		/* The method used
		 */
		$this->setMethod($_SERVER['REQUEST_METHOD']);
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
	public function getArgs() {
		return $this->args;
	}

	/**
	 * Set endpoint
	 *
	 * @param string $endpoint
	 */
	private function setEndpoint($endpoint) {
		$this->endpoint = $endpoint;
	}

	/**
	 * Get endpoint
	 *
	 * @return string
	 */
	public function getEndpoint() {
		return $this->endpoint;
	}

	/**
	 * Set method
	 *
	 * @param string $method
	 */
	private function setMethod($method) {
		$this->method = $method;
	}

	/**
	 * Get method
	 *
	 * @return string
	 */
	public function getMethod() {
		return $this->method;
	}
}