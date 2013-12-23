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
	 * The module to use
	 *
	 * @var string
	 */
	private $module = '';

	/**
	 * Constructor
	 *
	 * @param $request
	 */
	public function __construct($request) {
		$this->setRequest($request);

		/* The endpoint represents which module we'll look for first
 		 */
		$this->setModule(ucwords($this->getRequest()->getEndpoint()));

		$controllerMethod = $this->deriveControllerMethod();

		/* The controller object which will get instantiated and contains
		 * the method asked to run
		 */
		$objectName = $this->getModule() . '\Controller';

		if (method_exists($objectName, $controllerMethod)) {
			$object = new $objectName();
			$object->$controllerMethod();
		}
		else {
			echo $controllerMethod . '() not found';
		}
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

		/* Any special action to undertake
		 */
		$action = ucwords($this->getRequest()->getAction());

		/* Final controller name
		 */
		$controllerMethod = $controllerMethodPrefix . $this->getModule() . $action;

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
	private function getModule() {
		return $this->module;
	}
}