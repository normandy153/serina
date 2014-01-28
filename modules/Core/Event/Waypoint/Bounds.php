<?php
/**
 * Bounds
 *
 * Date: 28/01/14
 * Time: 2:29 AM
 */


namespace Core\Event\Waypoint;


class Bounds {

	/**
	 * Northest
	 *
	 * @var null
	 */
	private $northeast = null;

	/**
	 * Southwest
	 *
	 * @var null
	 */
	private $southwest = null;

	/**
	 * Constructor
	 *
	 * @param $bounds
	 */
	public function __construct($bounds) {
		$this->setNortheast($bounds->northeast);
		$this->setSouthwest($bounds->southwest);
	}

	/**
	 * Convert this to a json_encode friendly format
	 *
	 * @return array|mixed
	 */
	public function jsonSerialize() {
		return array(
			'northeast' => array(
				'lat' => $this->getNortheast()->lat,
				'lng' => $this->getNortheast()->lng
			),
			'southwest' => array(
				'lat' => $this->getSouthwest()->lat,
				'lng' => $this->getSouthwest()->lng
			)
		);
	}

	/* Getters/Setters
	 */

	/**
	 * Set northeast
	 *
	 * @param null $northeast
	 */
	private function setNortheast($northeast) {
		$this->northeast = $northeast;
	}

	/**
	 * Get northeast
	 *
	 * @return null
	 */
	private function getNortheast() {
		return $this->northeast;
	}

	/**
	 * Set southwest
	 *
	 * @param null $southwest
	 */
	private function setSouthwest($southwest) {
		$this->southwest = $southwest;
	}

	/**
	 * Get southwest
	 *
	 * @return null
	 */
	private function getSouthwest() {
		return $this->southwest;
	}
}