<?php
/**
 * Event model
 *
 * Date: 15/01/2014
 * Time: 12:14 AM
 */
namespace Core;

class Event {

	/**
	 * Identifier
	 *
	 * @var int
	 */
	private $id = 1;

	/**
	 * Event name
	 *
	 * @var string
	 */
	private $name = 'Test Event';

	/**
	 * Event brief
	 *
	 * @var string
	 */
	private $brief = '<p>Dynamically target high-payoff intellectual capital for customized technologies. Objectively integrate emerging core competencies before process-centric communities. Dramatically evisculate holistic innovation rather than client-centric data.</p>';

	/**
	 * Event description
	 *
	 * @var string
	 */
	private $description = '
		<p>Credibly reintermediate backend ideas for cross-platform models. Continually reintermediate integrated processes through technically sound intellectual capital. Holistically foster superior methodologies without market-driven best practices.</p>
		<p>Distinctively exploit optimal alignments for intuitive bandwidth. Quickly coordinate e-business applications through revolutionary catalysts for change. Seamlessly underwhelm optimal testing procedures whereas bricks-and-clicks processes.</p>
		<p>Synergistically evolve 2.0 technologies rather than just in time initiatives. Quickly deploy strategic networks with compelling e-business. Credibly pontificate highly efficient manufactured products and enabled data.</p>
		<p>Dynamically target high-payoff intellectual capital for customized technologies. Objectively integrate emerging core competencies before process-centric communities. Dramatically evisculate holistic innovation rather than client-centric data.</p>
		<p>Progressively maintain extensive infomediaries via extensible niches. Dramatically disseminate standardized metrics after resource-leveling processes. Objectively pursue diverse catalysts for change for interoperable meta-services.</p>';

	/**
	 * Start date
	 *
	 * @var string
	 */
	private $startDateTime = '2014-01-15 12:20:00';

	/**
	 * End date
	 *
	 * @var string
	 */
	private $endDateTime = '2014-01-17 17:00:00';

	/**
	 * Whether this event is hidden from the public
	 *
	 * @var bool
	 */
	private $hidden = false;

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
	 * A collection of Node instances which used addresses
	 *
	 * @var Event\Waypoint\PolyfillCollection
	 */
	private $waypoints = null;

	/**
	 * A collection of Marker instances which used lat/long
	 *
	 * @var \App\Collection
	 */
	private $markers = null;

	/**
	 * A collection of User instances
	 *
	 * @var null
	 */
	private $attendees = null;

	/**
	 * A collection of User instances
	 *
	 * @var null
	 */
	private $leaders = null;

	/**
	 * Constructor
	 */
	public function __construct() {

		/* Assemble waypoints
		 * Transcode nodes into a single polyfill collection
		 */
		$allWaypoints = array(
			'169-171 Berkeley Street, Melbourne, VIC, 3000',
			'Mansfield, Victoria, Australia',
			'Tawonga South, Australia',
		);

		$waypointCollection = new \Core\Event\Waypoint\PolyfillCollection($allWaypoints);
		$waypointCollection->transcode();

		/* Markers (Points of Interest)
		 */
		$markerCollection = new \App\Collection();

		$marker = new \Core\Event\Waypoint\Marker();
		$marker->setLatitude('-37.777185');
		$marker->setLongitude('144.834234');
		$marker->setDescription('A random place.');
		$markerCollection->add($marker);

		$marker = new \Core\Event\Waypoint\Marker();
		$marker->setLatitude('-36.732281');
		$marker->setLongitude('147.306061');
		$marker->setDescription('Mt. Bogong Summit');
		$markerCollection->add($marker);

		/* Attendees
		 */
		$attendees = new \App\Collection();
		$attendees->add(array(
			'firstname' => 'Test Firstname',
			'lastname' => 'Test Lastname',
		));

		/* People
		 */
		$leaders = new \App\Collection();
		$leaders->add(array(
			'firstname' => 'John',
			'lastname' => 'Doe',
		));

		$this->setWaypoints($waypointCollection);
		$this->setMarkers($markerCollection);
		$this->setAttendees($attendees);
		$this->setLeaders($leaders);
	}

	/* Getters/Setters
	 */

	/**
	 * Set end datetime
	 *
	 * @param string $endDateTime
	 */
	public function setEndDateTime($endDateTime) {
		$this->endDateTime = $endDateTime;
	}

	/**
	 * Get end datetime
	 *
	 * @return string
	 */
	public function getEndDateTime() {
		return $this->endDateTime;
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
	 * Set start datetime
	 *
	 * @param string $startDateTime
	 */
	public function setStartDateTime($startDateTime) {
		$this->startDateTime = $startDateTime;
	}

	/**
	 * Get start datetime
	 *
	 * @return string
	 */
	public function getStartDateTime() {
		return $this->startDateTime;
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
	 * @param null $markers
	 */
	public function setMarkers($markers) {
		$this->markers = $markers;
	}

	/**
	 * Get markers
	 *
	 * @return null
	 */
	public function getMarkers() {
		return $this->markers;
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
	 * Set attendees
	 *
	 * @param null $attendees
	 */
	public function setAttendees($attendees) {
		$this->attendees = $attendees;
	}

	/**
	 * Get attendees
	 *
	 * @return null
	 */
	public function getAttendees() {
		return $this->attendees;
	}

	/**
	 * Set leaders
	 *
	 * @param null $leaders
	 */
	public function setLeaders($leaders) {
		$this->leaders = $leaders;
	}

	/**
	 * Get leaders
	 *
	 * @return null
	 */
	public function getLeaders() {
		return $this->leaders;
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
}