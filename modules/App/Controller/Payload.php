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
	 * The dir in which templates are located
	 *
	 * @var string
	 */
	private $templateDir = '';

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
	private $vars = array();

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
		$this->setTemplateDir("{$dir}/{$request->getModule()}/Domain/{$request->getType()}/Templates/");
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
	 * Set template dir
	 *
	 * @param string $templateDir
	 */
	private function setTemplateDir($templateDir) {
		$this->templateDir = $templateDir;
	}

	/**
	 * Get template dir
	 *
	 * @return string
	 */
	public function getTemplateDir() {
		return $this->templateDir;
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