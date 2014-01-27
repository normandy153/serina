<?php
/**
 * Node
 *
 * This represents a place in the world represented by an address. This is
 * transcoded by Google Maps API for route plotting on a map canvas
 *
 * Date: 21/01/2014
 * Time: 10:58 PM
 */

namespace Core\Event\Waypoint;


class Node {

	/**
	 * Address of a waypoint to be geocoded
	 *
	 * @var string
	 */
	private $address = '';

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	/**
	 * Convert this to a json_encode friendly format
	 *
	 * @return array|mixed
	 */
	public function jsonSerialize() {
		return $this->getAddress();
	}

	/* Getters/Setters
	 */

	/**
	 * Set address
	 *
	 * @param string $address
	 * @return $this
	 */
	public function setAddress($address) {
		$this->address = $address;

		return $this;
	}

	/**
	 * Get address
	 *
	 * @return string
	 */
	public function getAddress() {
		return $this->address;
	}
}