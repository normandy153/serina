<?php
/**
 * ControllerFactory
 *
 * Date: 24/12/13
 * Time: 3:28 PM
 */


namespace Core;


class ControllerFactory {

	/**
	 * A list of locations which a Controller might exist
	 *
	 * @var array
	 */
	private $dirs = array(
		'Core', 'Custom'
	);

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

			if (class_exists($className)) {
				return new $className();
			}
		}

		throw new \Exception($this->getRequest()->getModule() . ' controller not found.');
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
}