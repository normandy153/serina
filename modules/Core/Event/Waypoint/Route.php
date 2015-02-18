<?php
/**
 * Route.php
 *
 * A wrapper for rendered Polyfills, associating them with events and
 * the polyfill string itself
 *
 * Date: 3/07/2014
 * Time: 12:06 AM
 */

namespace Core\Event\Waypoint;


class Route {

	/**
	 * Identifier
	 *
	 * @var int
	 */
	private $id = null;

	/**
	 * Event id
	 *
	 * @var int
	 */
	private $eventId = null;

	/**
	 * Json-encoded polyfill data
	 *
	 * @var string
	 */
	private $polyfill = '';

	/**
	 * A json-encoded bounds object
	 *
	 * @var string
	 */
	private $bounds = '';

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/* Getters/Setters
	 */

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
	 * Set polyfill
	 *
	 * @param string $polyfill
	 */
	public function setPolyfill($polyfill) {
		$this->polyfill = $polyfill;
	}

	/**
	 * Get polyfill
	 *
	 * @return string
	 */
	public function getPolyfill() {
		return $this->polyfill;
	}

	/**
	 * Set bounds
	 *
	 * @param string $bounds
	 */
	public function setBounds($bounds) {
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