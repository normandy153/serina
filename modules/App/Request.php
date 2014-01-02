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
	 * Requests taking place in one of these special areas
	 *
	 * @var array
	 */
	private $allTypes = array('Admin', 'Restricted');

	/**
	 * One of Admin, Restricted, Unrestricted
	 *
	 * @var string
	 */
	private $type = 'Unrestricted';

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

		/* Determine what type of access it was (either to admin,
		 * restricted/private or unrestricted/public areas of the framework)
		 */
		$type = ucwords($args[0]);

		if (in_array($type, $this->getAllTypes())) {
			$this->setType($type);
			array_shift($args);
		}

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

	/**
	 * Set type
	 *
	 * @param string $type
	 */
	private function setType($type) {
		$this->type = $type;
	}

	/**
	 * Get type
	 *
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Set all types
	 *
	 * @param array $allTypes
	 */
	private function setAllTypes($allTypes) {
		$this->allTypes = $allTypes;
	}

	/**
	 * Get all types
	 *
	 * @return array
	 */
	public function getAllTypes() {
		return $this->allTypes;
	}
}