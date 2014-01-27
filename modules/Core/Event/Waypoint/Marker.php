<?php
/**
 * Unencoded.php
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
	 */
	public function __construct() {
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

	/**
	 * Set description
	 *
	 * @param string $description
	 */
	public function setDescription($description) {
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