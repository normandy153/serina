<?php
/**
 * PayloadFactory
 *
 * Date: 24/12/13
 * Time: 5:47 PM
 */


namespace App;


class PayloadFactory {

	/**
	 * An instance of Payload
	 *
	 * @var null
	 */
	private $payload = null;

	/**
	 * Constructor
	 *
	 * @param $request
	 * @param $dir
	 * @param $output
	 */
	public function __construct($request, $dir, $output) {
		$merged = array_merge(array(
			'templateFile' => '',
			'vars' => array()
			), $output);

		$payload = new Controller\Payload($request, $dir, $merged['templateFile'], $merged['vars']);
		$this->setPayload($payload);
	}

	/**
	 * Build payload
	 *
	 * @return null
	 */
	public function build() {
		return $this->getPayload();
	}

	/* Getters/Setters
	 */

	/**
	 * @param null $payload
	 */
	private function setPayload($payload) {
		$this->payload = $payload;
	}

	/**
	 * @return null
	 */
	private function getPayload() {
		return $this->payload;
	}
}