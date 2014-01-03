<?php
/**
 * Theme
 *
 * Date: 3/01/14
 * Time: 7:50 PM
 */


namespace App;


class Theme {

	/**
	 * Theme name
	 *
	 * @var string
	 */
	private $name = 'Default';

	/**
	 * The dir in which theme fiels are located
	 * This is usually the /theme folder
	 *
	 * @var string
	 */
	private $dir = '';

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->setName('MUMC');
		$this->setDir(dirname(__FILE__) . '/../../theme/' . $this->getName());
	}

	/* Getters/Setters
	 */

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
	public function getDir() {
		return $this->dir;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 */
	private function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
}