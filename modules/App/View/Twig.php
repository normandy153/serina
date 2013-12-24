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
	private $vars = null;

	/**
	 * Constructor
	 *
	 * @param $request
	 * @param $dir
	 * @param $vars
	 */
	public function __construct($request, $dir, $vars) {
		$this->setRequest($request);
		$this->setDir($dir);
		$this->setVars($vars);

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
	 * Set vars
	 *
	 * @param null $vars
	 */
	private function setVars($vars) {
		$this->vars = $vars;
	}

	/**
	 * Get vars
	 *
	 * @return null
	 */
	private function getVars() {
		return $this->vars;
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