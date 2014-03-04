<?php
/**
 * Base.php
 *
 * Date: 6/02/2014
 * Time: 10:34 PM
 */

namespace Core\User\Generator;


abstract class Base {

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	/**
	 * Spawn an item
	 *
	 * @return mixed
	 */
	abstract protected function spawn();

	/**
	 * Get a particular option
	 *
	 * @return mixed
	 */
	protected function getOption() {
		$index = rand(0, count($this->getOptions())-1);

		return $this->options[$index];
	}

	/* Getters/Setters
	 */

	/**
	 * Set options
	 *
	 * @param array $options
	 */
	protected function setOptions($options) {
		$this->options = $options;
	}

	/**
	 * Get options
	 *
	 * @return array
	 */
	protected function getOptions() {
		return $this->options;
	}
} 