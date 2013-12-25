<?php
/**
 * ControllerFactory
 *
 * Date: 24/12/13
 * Time: 3:28 PM
 */


namespace App\Controller;


class Factory {

	/**
	 * A list of locations which a Controller might exist
	 *
	 * @var array
	 */
	private $dirs = array(
		'Custom', 'Core'
	);

	/**
	 * The dir in which the controller was found
	 *
	 * @var string
	 */
	private $dir = '';

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
	}

	/**
	 * Find a controller object to spawn
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function build() {

		/* Look in custom then core dirs for a module's controller
		 * Spawn one and return it if found; otherwise frag out
		 */
		foreach($this->getDirs() as $currentDir) {
			$className = "\\{$currentDir}\\{$this->getRequest()->getModule()}\\Controller";

			/* Remember where it was found
			 */
			if (class_exists($className)) {
				$this->setDir($currentDir);

				return new $className($this->getRequest()->getArgs());
			}
		}
	}

	/* Getters/Setters
	 */

	/**
	 * Set dirs
	 *
	 * @param array $dirs
	 */
	private function setDirs($dirs) {
		$this->dirs = $dirs;
	}

	/**
	 * Get dirs
	 *
	 * @return array
	 */
	private function getDirs() {
		return $this->dirs;
	}

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
	 * @param string $dir
	 */
	private function setDir($dir) {
		$this->dir = $dir;
	}

	/**
	 * @return string
	 */
	public function getDir() {
		return $this->dir;
	}
}