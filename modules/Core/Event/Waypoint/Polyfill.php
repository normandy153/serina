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
	 * A json-encoded bounds object
	 *
	 * @var string
	 */
	private $bounds = '';

	/**
	 * Constructor
	 *
	 * @param $polyfill
	 * @param $bounds
	 */
	public function __construct($polyfill, $bounds) {

		/* Automatically base64_encode the polyfill - javascript interprets
		 * \w, \l etc as special meanings and will throw you ILLEGAL STRING
		 * errors. base64_encode will hide those literals. All polyfills are
		 * base64_encoded in the db.
		 */
		$this->setPolyfillString(base64_encode($polyfill));

		/* Save a cached version of the bounds
		 */
		$this->setBounds($bounds);
	}

	/**
	 * Convert this to a json_encode friendly format
	 *
	 * @return array|mixed
	 */
	public function jsonSerialize() {
		return json_encode(array(
			'polyfill' => $this->getPolyfillString(),
			'bounds' => $this->getBounds()
		));
	}

	/**
	 * Get bounds as a json string
	 *
	 * @return string
	 */
	public function getBoundsJson() {
		return json_encode($this->getBounds());
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
	public function getPolyfillString() {
		return $this->polyfillString;
	}

	/**
	 * Set bounds
	 *
	 * @param string $bounds
	 */
	private function setBounds($bounds) {
		$this->bounds = $bounds;
	}

	/**
	 * Get bounds
	 *
	 * @return string
	 */
	public function getBounds() {
		return $this->bounds;
	}
}