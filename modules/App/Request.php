<?php
/**
 * Request
 *
 * Date: 23/12/13
 * Time: 10:22 PM
 */


namespace App;


class Request {

	/**
	 * Method used in the request (GET/PUT/POST/DELETE)
	 *
	 * @var string
	 */
	private $method = '';

	/**
	 * Module endpoint
	 *
	 * @var string
	 */
	private $endpoint = '';

	/**
	 * The module to use
	 *
	 * @var string
	 */
	private $module = '';

	/**
	 * An action for the endpoint
	 *
	 * @var string
	 */
	private $action = '';

	/**
	 * Provided arguments
	 *
	 * @var array
	 */
	private $args = array();

	/**
	 * An instance of RequestStatus
	 *
	 * @var null
	 */
	private $requestStatus = null;

	/**
	 * Default controller method to run
	 *
	 * @var string
	 */
	private $defaultRoute = 'test/22';

	/**
	 * Constructor
	 *
	 * @param $request
	 */
	public function __construct($request) {

		/* The method used
 		 */
		$this->setMethod($_SERVER['REQUEST_METHOD']);

		/* Default controller to use
		 */
		if (count(array_keys($request))) {
			$route = $request['route'];
		}
		else {
			$route = $this->getDefaultRoute();
		}

		/* Decide args and endpoint for restful interface
		 */
		$args = explode('/', rtrim($route));
		$endpoint = array_shift($args);

		$this->setArgs($args);
		$this->setEndpoint($endpoint);
		$this->setModule(ucwords($this->getEndpoint()));

		/* Check if the second argument is non-numeric, in case something special
		 * needs to happen, like file uploads: e.g. /event/list, /event/detail etc
		 */
		if (array_key_exists(0, $this->getArgs()) && !preg_match('/[0-9]+/', $args[0])) {
			$this->setAction(ucwords($args[0]));
		}
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

	/**
	 * Set action
	 *
	 * @param string $action
	 */
	private function setAction($action) {
		$this->action = $action;
	}

	/**
	 * Get action
	 *
	 * @return string
	 */
	public function getAction() {
		return $this->action;
	}

	/**
	 * Set module
	 *
	 * @param string $module
	 */
	private function setModule($module) {
		$this->module = $module;
	}

	/**
	 * Get module
	 *
	 * @return string
	 */
	public function getModule() {
		return $this->module;
	}

	/**
	 * Set request status
	 *
	 * @param null $requestStatus
	 */
	public function setRequestStatus($requestStatus) {
		$this->requestStatus = $requestStatus;
	}

	/**
	 * Get request status
	 *
	 * @return null
	 */
	public function getRequestStatus() {
		return $this->requestStatus;
	}

	/**
	 * Set default route
	 *
	 * @param string $defaultRoute
	 */
	private function setDefaultRoute($defaultRoute) {
		$this->defaultRoute = $defaultRoute;
	}

	/**
	 * Get default route
	 *
	 * @return string
	 */
	private function getDefaultRoute() {
		return $this->defaultRoute;
	}
}