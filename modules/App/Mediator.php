<?php
/**
 * Mediator
 *
 * Date: 23/12/13
 * Time: 10:12 PM
 */


namespace App;

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
		$controllerFactory = new Controller\Factory($this->getRequest());
		$controller = $controllerFactory->build();

		$method = $this->deriveControllerMethod();

		/* Run controller if method exists
		 */
		if (!method_exists($controller, $method)) {
			$requestStatus = new RequestStatus("No endpoint: {$method}", 404);
		}
		else {
			$requestStatus = new RequestStatus(null, 200);
			$controller->$method();
		}

		/* Get the request status and append it so you can render out the
		 * error screen(s) accordingly
		 */
		$this->getRequest()->setRequestStatus($requestStatus);

		new Probe($this->getRequest());

		/* Generate output payload
		 */
		$payloadFactory = new PayloadFactory($this->getRequest(), $controllerFactory->getDir(), $controller->getOutput());
		$payload = $payloadFactory->build();

		/* Render output via twig
		 */
		$renderer = new View\Twig($payload);
		$renderer->render();
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