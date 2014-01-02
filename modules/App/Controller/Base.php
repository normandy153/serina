<?php
/**
 * ControllerAbstract
 *
 * Date: 24/12/13
 * Time: 3:57 PM
 */


namespace App\Controller;


abstract class Base {

	/**
	 * A list of arguments provided in the request
	 *
	 * @var array
	 */
	protected $args = array();

	/**
	 * Controller output
	 *
	 * @var array
	 */
	protected $output = array();

	/**
	 * Constructor
	 *
	 * @param $args
	 */
	public function __construct($args) {
		$this->setArgs($args);

		$this->setup();
	}

	/**
	 * Hook method
	 *
	 * @return mixed
	 */
	abstract protected function setup();

	/**
	 * Store controller output
	 *
	 * @param $templateFile
	 * @param $vars
	 */
	final protected function output($templateFile, $vars) {
		$output = array(
			'templateFile' => $templateFile,
			'vars' => $vars,
		);

		$this->setOutput($output);
	}

	/* Getters/Setters
	 */

	/**
	 * Set args
	 *
	 * @param array $args
	 */
	private function setArgs($args) {
		$this->args = $args;
	}

	/**
	 * Get args
	 *
	 * @return array
	 */
	protected function getArgs() {
		return $this->args;
	}

	/**
	 * @param array $output
	 */
	protected function setOutput($output) {
		$this->output = $output;
	}

	/**
	 * @return array
	 */
	public function getOutput() {
		return $this->output;
	}
}