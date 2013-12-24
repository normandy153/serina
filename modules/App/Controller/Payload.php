<?php
/**
 * Payload
 *
 * Date: 24/12/13
 * Time: 5:20 PM
 */


namespace App\Controller;


class Payload {

	/**
	 * The .html file to load, by default
	 * This should not have the .html extension
	 *
	 * @var string
	 */
	private $templateFile = '';

	/**
	 * The data to render
	 *
	 * @var null
	 */
	private $vars = null;

	/**
	 * Constructor
	 *
	 * @param $templateFile
	 * @param $vars
	 */
	public function __construct($templateFile, $vars) {
		$this->setTemplateFile($templateFile);
		$this->setVars($vars);
	}

	/* Getters/Setters
	 */

	/**
	 * Set template file
	 *
	 * @param string $templateFile
	 */
	private function setTemplateFile($templateFile) {
		$this->templateFile = $templateFile;
	}

	/**
	 * Get template file
	 *
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->templateFile;
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
	public function getVars() {
		return $this->vars;
	}
}