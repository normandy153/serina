<?php
/**
 * Waypoint.php
 *
 * Date: 26/06/2014
 * Time: 9:04 PM
 */

namespace Core\Event;


class Waypoint {

	/**
	 * Identifier
	 *
	 * @var null
	 */
	private $id = null;

	/**
	 * Event to which this waypoint belongs
	 *
	 * @var null
	 */
	private $eventId = null;

	/**
	 * Address for reverse geocoding
	 *
	 * @var string
	 */
	private $address = '';

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/* Getters/Setters
	 */

	/**
	 * Set address
	 *
	 * @param string $address
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * Get address
	 *
	 * @return string
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Set id
	 *
	 * @param null $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * Get id
	 *
	 * @return null
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set event id
	 *
	 * @param null $eventId
	 */
	public function setEventId($eventId) {
		$this->eventId = $eventId;
	}

	/**
	 * Get event id
	 *
	 * @return null
	 */
	public function getEventId() {
		return $this->eventId;
	}
} 