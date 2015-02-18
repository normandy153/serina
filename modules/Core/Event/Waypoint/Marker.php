<?php
/**
 * Marker
 *
 * A latitude/longitude represented location in the world
 *
 * Date: 21/01/2014
 * Time: 10:58 PM
 */

namespace Core\Event\Waypoint;


class Marker implements \JsonSerializable {

	/**
	 * Latitude of a marker
	 *
	 * @var string
	 */
	private $latitude = '';

	/**
	 * Longitude of a marker
	 *
	 * @var string
	 */
	private $longitude = '';

	/**
	 * A description for this marker
	 *
	 * @var string
	 */
	private $description = '';

	/**
	 * Constructor
	 *
	 * @param $latitude
	 * @param $longitude
	 * @param $description
	 */
	public function __construct($latitude, $longitude, $description) {
		$this->setLatitude($latitude);
		$this->setLongitude($longitude);
		$this->setDescription($description);
	}

	/**
	 * Convert this to a json_encode friendly format
	 *
	 * @return array|mixed
	 */
	public function jsonSerialize() {
		return array(
			'latitude' => $this->getLatitude(),
			'longitude' => $this->getLongitude(),
			'description' => $this->getDescription()
		);
	}

	/* Getters/Setters
	 */

	/**
	 * Set latitude
	 *
	 * @param string $latitude
	 * @return $this
	 */
	private function setLatitude($latitude) {
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
	private function setLongitude($longitude) {
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

	/**
	 * Set description
	 *
	 * @param string $description
	 */
	private function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}
}