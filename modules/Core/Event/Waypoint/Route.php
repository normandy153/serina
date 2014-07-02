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

	private $id = null;

	private $eventId = null;

	private $polyfill = '';

	public function __construct() {

	}

	/* Getters/Setters
	 */

	/**
	 * @param null $eventId
	 */
	public function setEventId($eventId) {
		$this->eventId = $eventId;
	}

	/**
	 * @return null
	 */
	public function getEventId() {
		return $this->eventId;
	}

	/**
	 * @param null $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return null
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param string $polyfill
	 */
	public function setPolyfill($polyfill) {
		$this->polyfill = $polyfill;
	}

	/**
	 * @return string
	 */
	public function getPolyfill() {
		return $this->polyfill;
	}
} 