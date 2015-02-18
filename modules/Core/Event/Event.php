<?php
/**
 * Event model
 *
 * Date: 15/01/2014
 * Time: 12:14 AM
 */
namespace Core\Event;

use \App\Collection;

class Event {

	/**
	 * Identifier
	 *
	 * @var int
	 */
	private $id = null;

	/**
	 * Public unique identifier
	 *
	 * @var string
	 */
	private $uuid = '';

	/**
	 * Event name
	 *
	 * @var string
	 */
	private $name = '';

	/**
	 * Event brief
	 *
	 * @var string
	 */
	private $brief = '';

	/**
	 * Event description
	 *
	 * @var string
	 */
	private $description = '';

	/**
	 * Meeting date
	 *
	 * @var string
	 */
	private $meetingAt = '';

	/**
	 * Start date
	 *
	 * @var string
	 */
	private $startAt = '';

	/**
	 * End date
	 *
	 * @var string
	 */
	private $endAt = '';

	/**
	 * Whether this event is hidden from the public
	 *
	 * @var bool
	 */
	private $hidden = false;

	/**
	 * Routes (polyfills) for this event
	 *
	 * @var \App\Collection
	 */
	private $waypoints = null;

	/**
	 * Markers for this event
	 *
	 * @var \App\Collection
	 */
	private $markers = null;

	/**
	 * When this event was created
	 *
	 * @var string
	 */
	private $createdAt = '';

	/**
	 * When this event was last updated
	 *
	 * @var string
	 */
	private $updatedAt = '';

	/**
	 * When this event was softdeleted
	 *
	 * @var string
	 */
	private $deletedAt = '';

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->setWaypoints(new Collection());
	}

	/**
	 * Generate uuid
	 */
	public function generateUuid() {
		$base = strtoupper(sha1(crypt(microtime() . rand(0,10000))));

		return trim(chunk_split($base, 4, '-'), '-');
	}

	/* Getters/Setters
	 */

	/**
	 * Set end at
	 *
	 * @param string $endAt
	 */
	public function setEndAt($endAt) {
		$this->endAt = $endAt;
	}

	/**
	 * Get end at
	 *
	 * @return string
	 */
	public function getEndAt() {
		return $this->endAt;
	}

	/**
	 * Set start at
	 *
	 * @param string $startAt
	 */
	public function setStartAt($startAt) {
		$this->startAt = $startAt;
	}

	/**
	 * Get start at
	 *
	 * @return string
	 */
	public function getStartAt() {
		return $this->startAt;
	}

	/**
	 * Set meeting at
	 *
	 * @param string $meetingAt
	 */
	public function setMeetingAt($meetingAt) {
		$this->meetingAt = $meetingAt;
	}

	/**
	 * Get meeting at
	 *
	 * @return string
	 */
	public function getMeetingAt() {
		return $this->meetingAt;
	}

	/**
	 * Set id
	 *
	 * @param int $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
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

	/**
	 * Set event brief
	 *
	 * @param string $brief
	 */
	public function setBrief($brief) {
		$this->brief = $brief;
	}

	/**
	 * Get brief
	 *
	 * @return string
	 */
	public function getBrief() {
		return $this->brief;
	}

	/**
	 * Set hidden
	 *
	 * @param boolean $hidden
	 */
	public function setHidden($hidden) {
		$this->hidden = $hidden;
	}

	/**
	 * Get hidden
	 *
	 * @return boolean
	 */
	public function getHidden() {
		return $this->hidden;
	}

	/**
	 * Set uuid
	 *
	 * @param string $uuid
	 */
	public function setUuid($uuid) {
		$this->uuid = $uuid;
	}

	/**
	 * Get uuid
	 *
	 * @return string
	 */
	public function getUuid() {
		return $this->uuid;
	}

	/**
	 * Set created at
	 *
	 * @param string $createdAt
	 */
	public function setCreatedAt($createdAt) {
		$this->createdAt = $createdAt;
	}

	/**
	 * Get created at
	 *
	 * @return string
	 */
	public function getCreatedAt() {
		return $this->createdAt;
	}

	/**
	 * Set updated at
	 *
	 * @param string $updatedAt
	 */
	public function setUpdatedAt($updatedAt) {
		$this->updatedAt = $updatedAt;
	}

	/**
	 * Get updated at
	 *
	 * @return string
	 */
	public function getUpdatedAt() {
		return $this->updatedAt;
	}

	/**
	 * Set deleted at
	 *
	 * @param string $deletedAt
	 */
	public function setDeletedAt($deletedAt) {
		$this->deletedAt = $deletedAt;
	}

	/**
	 * Get deleted at
	 *
	 * @return string
	 */
	public function getDeletedAt() {
		return $this->deletedAt;
	}

	/**
	 * Set waypoints
	 *
	 * @param null $waypoints
	 */
	public function setWaypoints($waypoints) {
		$this->waypoints = $waypoints;
	}

	/**
	 * Get waypoints
	 *
	 * @return null
	 */
	public function getWaypoints() {
		return $this->waypoints;
	}

	/**
	 * Set markers
	 *
	 * @param \App\Collection $markers
	 */
	public function setMarkers($markers) {
		$this->markers = $markers;
	}

	/**
	 * Get markers
	 *
	 * @return \App\Collection
	 */
	public function getMarkers() {
		return $this->markers;
	}
}