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
		$controllerFactory = new \Core\ControllerFactory($this->getRequest());
		$controller = $controllerFactory->build();

		new \Core\Probe($controller);

		/* Normally check that a view method also exists, but instead,
		 * pipe through straight to twig
		 */
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