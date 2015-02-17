<?php
/**
 * Polyfill
 *
 * Date: 28/01/14
 * Time: 2:38 AM
 */


namespace Core\Event\Waypoint;


class Polyfill implements \JsonSerializable {

	/**
	 * Polyfill string from Google Maps result
	 *
	 * @var string
	 */
	private $polyfillString = '';

	/**
	 * Constructor
	 *
	 * @param $polyfill
	 */
	public function __construct($polyfill) {

		/* Automatically base64_encode the polyfill - javascript interprets
		 * \w, \l etc as special meanings and will throw you ILLEGAL STRING
		 * errors. base64_encode will hide those literals. All polyfills are
		 * base64_encoded in the db.
		 */
		$this->setPolyfillString(base64_encode($polyfill));
	}

	/**
	 * Convert this to a json_encode friendly format
	 *
	 * @return array|mixed
	 */
	public function jsonSerialize() {
		return $this->getPolyfillString();
	}

	/* Getters/Setters
	 */

	/**
	 * Set polyfill string
	 *
	 * @param string $polyfillString
	 */
	private function setPolyfillString($polyfillString) {
		$this->polyfillString = $polyfillString;
	}

	/**
	 * Get polyfill string
	 *
	 * @return string
	 */
	private function getPolyfillString() {
		return $this->polyfillString;
	}
}