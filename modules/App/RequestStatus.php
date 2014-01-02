<?php
/**
 * RequestStatus
 *
 * Date: 25/12/13
 * Time: 3:21 PM
 */


namespace App;


class RequestStatus {

	/**
	 * Status of the request
	 *
	 * @var array
	 */
	private $status = array(
		200 => 'OK',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		500 => 'Internal Server Error',
	);

	/**
	 * Message to include in header
	 *
	 * @var string
	 */
	private $message = '';

	/**
	 * Response code
	 *
	 * @var int
	 */
	private $code = 200;

	/**
	 * Header response
	 *
	 * @var string
	 */
	private $header = '';

	/**
	 * Constructor
	 *
	 * @param $message
	 * @param $code
	 */
	public function __construct($message, $code) {
		$this->setMessage($message);
		$this->setCode($code);

		$this->setHeader("HTTP/1.1 {$code} {$this->getStatusForCode($code)}");
	}

	/**
	 * Text version of the http code
	 *
	 * @param $code
	 * @return int
	 */
	private function getStatusForCode($code) {
		if (isset($this->status[$code])) {
			return $this->status[$code];
		}

		return 500;
	}

	/**
	 * Determine whether an error occurred
	 *
	 * @return bool
	 */
	public function hasError() {
		if ($this->getCode() > 399) {
			return true;
		}

		return false;
	}

	/**
	 * Set code
	 *
	 * @param int $code
	 */
	private function setCode($code) {
		$this->code = $code;
	}

	/**
	 * Get code
	 *
	 * @return int
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * Set message
	 *
	 * @param string $message
	 */
	private function setMessage($message) {
		$this->message = $message;
	}

	/**
	 * Get message
	 *
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * Set status
	 *
	 * @param array $status
	 */
	private function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * Get status
	 *
	 * @return array
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Set header
	 *
	 * @param string $header
	 */
	private function setHeader($header) {
		$this->header = $header;
	}

	/**
	 * Get header
	 *
	 * @return string
	 */
	public function getHeader() {
		return $this->header;
	}
}