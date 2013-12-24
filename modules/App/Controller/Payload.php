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
	 * @param $request
	 * @param $dir
	 * @param $templateFile
	 * @param $vars
	 */
	public function __construct($request, $dir, $templateFile, $vars) {
		$this->setRequest($request);
		$this->setDir($dir);
		$this->setTemplateFile($templateFile);
		$this->setVars($vars);
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
	public function getRequest() {
		return $this->request;
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
	public function getDir() {
		return $this->dir;
	}

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