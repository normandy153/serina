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
	 * @throws \Exception
	 */
	public function __construct($request) {
		$this->setRequest($request);

		/* The controller object which will get instantiated and contains
		 * the method asked to run
		 */
		$controllerFactory = new ControllerFactory($this->getRequest());
		$controller = $controllerFactory->build();

		$method = $this->deriveControllerMethod();

		/* Run controller if method exists
		 */
		if (method_exists($controller, $method)) {
			$controller->$method();
		}
		else {
			throw new \Exception("$method not found.");
		}

		/* Normally check that a view method also exists, but instead,
		 * pipe through straight to twig
		 */
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

		/* The module to use
		 */
		$module = $this->getRequest()->getModule();

		/* Any special action to undertake
		 */
		$action = $this->getRequest()->getAction();

		/* Final controller name
		 */
		$controllerMethod = $controllerMethodPrefix . $module . $action;

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