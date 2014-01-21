<?php
/**
 * Unencoded.php
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
	 * Latitude of a waypoint
	 *
	 * @var string
	 */
	private $latitude = '';

	/**
	 * Longitude of a waypoint
	 *
	 * @var string
	 */
	private $longitude = '';

	/**
	 * Constructor
	 *
	 * @param $address
	 */
	public function __construct($address) {
		$this->setAddress($address);
	}

	/* Getters/Setters
	 */

	/**
	 * Set address
	 *
	 * @param string $address
	 */
	private function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * Get address
	 *
	 * @return string
	 */
	private function getAddress() {
		return $this->address;
	}

	/**
	 * Set latitude
	 *
	 * @param string $latitude
	 * @return $this
	 */
	public function setLatitude($latitude) {
		$this->latitude = $latitude;

		return $this;
	}

	/**
	 * Get latitude
	 *
	 * @return string
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * Set longitude
	 *
	 * @param string $longitude
	 * @return $this
	 */
	public function setLongitude($longitude) {
		$this->longitude = $longitude;

		return $this;
	}

	/**
	 * Get longitude
	 *
	 * @return string
	 */
	public function getLongitude() {
		return $this->longitude;
	}
} 