<?php
/**
 * Twig
 *
 * Date: 24/12/13
 * Time: 4:45 PM
 */


namespace App\View;


class Twig {

	/**
	 * An instance of Request
	 *
	 * @var null
	 */
	private $request = null;

	/**
	 * The dir in which to load template files
	 * This allows Custom to precede Core
	 *
	 * @var string
	 */
	private $dir = '';

	/**
	 * The data to render
	 *
	 * @var null
	 */
	private $payload = null;

	/**
	 * Constructor
	 *
	 * @param $request
	 * @param $dir
	 * @param \App\Controller\Payload $payload
	 */
	public function __construct($request, $dir, \App\Controller\Payload $payload) {
		$this->setRequest($request);
		$this->setDir($dir);
		$this->setPayload($payload);

		$this->setup();
	}

	/**
	 * Hook method
	 */
	protected function setup() {

		/* Normally check that a view method also exists, but instead,
		 * pipe through straight to twig
		 */
		$vendorPath = dirname(__FILE__) . '/../../../vendor';

		require_once("$vendorPath/Twig-1.15.0/lib/Twig/Autoloader.php");
		\Twig_Autoloader::register();
	}

	/**
	 * Render vars in twig
	 */
	public function render() {
		$loader = new \Twig_Loader_String();
		$twig = new \Twig_Environment($loader);

		new \App\Probe($this->getDir());
		echo $twig->render('Hello {{ name }}!', array('name' => 'Fabien'));
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
	 * Set payload
	 *
	 * @param null $payload
	 */
	private function setPayload($payload) {
		$this->payload = $payload;
	}

	/**
	 * Get payload
	 *
	 * @return null
	 */
	private function getPayload() {
		return $this->payloadd;
	}

	/**
	 * Set dir
	 *
	 * @param string $dir
	 */
	private function setDir($dir) {
		$this->dir = $dir;
	}

	/**
	 * Get dir
	 *
	 * @return string
	 */
	private function getDir() {
		return $this->dir;
	}
}