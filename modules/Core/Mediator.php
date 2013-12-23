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

		$controllerMethod = $this->deriveControllerMethod();

		
		new \Core\Probe($controllerMethod);
	}

	/**
	 * Determine controller method to use
	 *
	 * @return string
	 */
	private function deriveControllerMethod() {
		/* The prefix to the action, as determined by request method
		 * This will be one of get, put, post, delete
		 */
		$controllerMethodPrefix = strtolower($this->getRequest()->getMethod());

		/* The endpoint represents which module we'll look for first
		 */
		$moduleName = ucwords($this->getRequest()->getEndpoint());

		/* Any special action to undertake
		 */
		$action = ucwords($this->getRequest()->getAction());

		/* Final controller name
		 */
		$controllerMethod = $controllerMethodPrefix . $moduleName . $action;

		return $controllerMethod;
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