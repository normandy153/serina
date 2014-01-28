<?php
/**
 * Curl.php
 *
 * Date: 22/01/2014
 * Time: 2:05 AM
 */

namespace App;


class Curl {

	/**
	 * The url to access
	 *
	 * @var string
	 */
	private $url = '';

	/**
	 * Additional curl options in key/value pair syntax
	 *
	 * @var array
	 */
	private $optionsArray = array();

	/**
	 * curl result string
	 *
	 * @var string
	 */
	private $result = '';

	/**
	 * curl errors
	 *
	 * @var string
	 */
	private $errors = '';

	/**
	 * Constructor
	 *
	 * @param $url
	 */
	public function __construct($url) {
		$this->setUrl($url);
	}

	/**
	 * Curl away
	 */
	public function exec() {
		$defaultOptions = array(
			CURLOPT_URL => $this->getUrl(),
			CURLOPT_RETURNTRANSFER => true
		);

		$allOptions = $defaultOptions + $this->getOptionsArray();

		$curl = curl_init();
		curl_setopt_array($curl, $allOptions);

		$this->setResult(curl_exec($curl));
		$this->setErrors(curl_error($curl));

		return $this;
	}

	/* Getters/Setters
	 */

	/**
	 * Set options array
	 *
	 * @param array $optionsArray
	 * @return $this
	 */
	public function setOptionsArray($optionsArray) {
		$this->optionsArray = $optionsArray;

		return $this;
	}

	/**
	 * Get options array
	 *
	 * @return array
	 */
	public function getOptionsArray() {
		return $this->optionsArray;
	}

	/**
	 * Set url
	 *
	 * @param string $url
	 */
	private function setUrl($url) {
		$this->url = $url;
	}

	/**
	 * Get url
	 *
	 * @return string
	 */
	private function getUrl() {
		return $this->url;
	}

	/**
	 * Set errors
	 *
	 * @param string $errors
	 */
	private function setErrors($errors) {
		$this->errors = $errors;
	}

	/**
	 * Get errors
	 *
	 * @return string
	 */
	public function getErrors() {
		return $this->errors;
	}

	/**
	 * Set result
	 *
	 * @param string $result
	 */
	private function setResult($result) {
		$this->result = $result;
	}

	/**
	 * Get result
	 *
	 * @return string
	 */
	public function getResult() {
		return $this->result;
	}
}