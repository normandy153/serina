<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sarif
 * Date: 7/01/2014
 * Time: 10:23 PM
 * To change this template use File | Settings | File Templates.
 */

namespace App;


class Router {

	/**
	 * Custom routes
	 *
	 * @var array
	 */
	private $allRegex = array(

		/* Homepage
		 */
		array(
			'pattern' => '/$^/',
			'replace' => '/test/1',
		),
	);

	/**
	 * An array containing key 'route'
	 * Usually $_REQUEST or $_GET
	 *
	 * @var array
	 */
	private $data = array();

	/**
	 * Constructor
	 *
	 * @param $data
	 */
	public function __construct($data) {
		$this->setData($data);
	}

	/**
	 * Produce a
	 */
	public function produce() {
		$data = $this->getData();
		
		/* If the root was selected, this will be empty
		 */
		if (!isset($data['route'])) {
			$data['route'] = '';
		}

		/* Default is the url provided
		 */
		$newRoute = $data['route'];

		/* Match route against any special overrides and
		 * manufacture a Request object accordingly
		 */
		foreach($this->getAllRegex() as $currentRegex) {
			if (preg_match($currentRegex['pattern'], $data['route'])) {
				$newRoute = preg_replace($currentRegex['pattern'], $currentRegex['replace'], $data['route']);

				break;
			}
		}

		return new Request($newRoute);
	}

	/* Getters/Setters
	 */

	/**
	 * Set all regex
	 *
	 * @param array $allRegex
	 */
	private function setAllRegex($allRegex) {
		$this->allRegex = $allRegex;
	}

	/**
	 * Get all regex
	 *
	 * @return array
	 */
	private function getAllRegex() {
		return $this->allRegex;
	}

	/**
	 * Set data
	 *
	 * @param array $data
	 */
	private function setData($data) {
		$this->data = $data;
	}

	/**
	 * Get data
	 *
	 * @return array
	 */
	private function getData() {
		return $this->data;
	}
}