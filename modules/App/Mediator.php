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
	 * @var \App\Request
	 */
	private $request = null;

	/**
	 * An instance of Theme
	 *
	 * @var \App\Theme
	 */
	private $theme = null;

	/**
	 * Constructor
	 *
	 * @param Request $request
	 * @param Theme $theme
	 */
	public function __construct(Request $request, Theme $theme) {
		$this->setRequest($request);
		$this->setTheme($theme);
	}

	/**
	 * Run controller and view
	 */
	public function run() {

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

			$output = array();
		}
		else {
			$requestStatus = new RequestStatus(null, 200);
			$controller->$method();

			$output = $controller->getOutput();
		}

		/* Get the request status and append it so you can render out the
		 * error screen(s) accordingly
		 */
		$this->getRequest()->setRequestStatus($requestStatus);

		/* Generate output payload
		 */
		$payloadFactory = new Controller\PayloadFactory($this->getRequest(), $controllerFactory->getDir(), $output);
		$payload = $payloadFactory->build();

		/* Render output via twig
		 */
		$renderer = new View\Twig($payload, $this->getTheme());
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

	/**
	 * Set theme
	 *
	 * @param null $theme
	 */
	private function setTheme($theme) {
		$this->theme = $theme;
	}

	/**
	 * Get theme
	 *
	 * @return null
	 */
	public function getTheme() {
		return $this->theme;
	}
}