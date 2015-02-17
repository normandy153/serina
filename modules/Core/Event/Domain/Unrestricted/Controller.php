<?php
/**
 * Event
 *
 * Date: 14/01/2014
 * Time: 11:46 PM
 */

namespace Core\Event\Domain\Unrestricted;

use App\Collection;
use App\Controller\Domain\Unrestricted;
use App\Probe;
use Core\Event\Event;
use Core\Event\EventMapper;
use Core\Event\Waypoint;
use Core\Event\WaypointMapper;

class Controller extends Unrestricted {

	/**
	 * Prepare a form to create a new Event
	 */
	public function getEventCreate() {
		$this->output('getEventCreate', array());
	}

	/**
	 * Create a new Event
	 */
	public function postEventCreate() {
		$now = date('Y-m-d h:i:s');

		/* Meeting Date/Time
		 */
		$dateElements = array(
			sprintf("%02d", $_POST['meetingAt']['year']),
			sprintf("%02d", $_POST['meetingAt']['month']),
			sprintf("%02d", $_POST['meetingAt']['day']),
		);

		$timeElements = array(
			sprintf("%02d", $_POST['meetingAt']['meridiem'] == 'pm' ? $_POST['meetingAt']['hour']+12 : $_POST['meetingAt']['hour']),
			sprintf("%02d", $_POST['meetingAt']['minute']),
			'00',
		);

		$meetingAt = implode('-', $dateElements) . ' ' . implode(':', $timeElements);

		/* Start Date/Time
		 */
		$dateElements = array(
			sprintf("%02d", $_POST['startAt']['year']),
			sprintf("%02d", $_POST['startAt']['month']),
			sprintf("%02d", $_POST['startAt']['day']),
		);

		$timeElements = array(
			sprintf("%02d", $_POST['startAt']['meridiem'] == 'pm' ? $_POST['startAt']['hour']+12 : $_POST['startAt']['hour']),
			sprintf("%02d", $_POST['startAt']['minute']),
			'00',
		);

		$startAt = implode('-', $dateElements) . ' ' . implode(':', $timeElements);

		/* End Date/Time
		 */
		$dateElements = array(
			sprintf("%02d", $_POST['endAt']['year']),
			sprintf("%02d", $_POST['endAt']['month']),
			sprintf("%02d", $_POST['endAt']['day']),
		);

		$timeElements = array(
			sprintf("%02d", $_POST['endAt']['meridiem'] == 'pm' ? $_POST['endAt']['hour']+12 : $_POST['endAt']['hour']),
			sprintf("%02d", $_POST['endAt']['minute']),
			'00',
		);

		$endAt = implode('-', $dateElements) . ' ' . implode(':', $timeElements);

		/* Event
		 */
		$event = new Event();
		$event->setName($_POST['name']);
		$event->setBrief($_POST['brief']);
		$event->setDescription($_POST['description']);
		$event->setMeetingAt($meetingAt);
		$event->setStartAt($startAt);
		$event->setEndAt($endAt);
		$event->setHidden(1);
		$event->setUuid($event->generateUuid());
		$event->setCreatedAt($now);
		$event->setUpdatedAt($now);
		$event->setDeletedAt(null);

		$eventMapper = new EventMapper();
		$eventMapper->save($event);

		header("Location: /event/update/{$event->getId()}");
	}

	/**
	 * Update an existing Event
	 */
	public function getEventUpdate() {
		$args = $this->getArgs();

		$eventMapper = new EventMapper();

		$event = $eventMapper->findDetailedById($args[1]);

		$this->output('getEventUpdate', array(
			'event' => $event
		));
	}

	/**
	 * Update an existing Event
	 */
	public function postEventUpdate() {
		$now = date('Y-m-d h:i:s');

		/* Meeting Date/Time
		 */
		$dateElements = array(
			sprintf("%02d", $_POST['meetingAt']['year']),
			sprintf("%02d", $_POST['meetingAt']['month']),
			sprintf("%02d", $_POST['meetingAt']['day']),
		);

		$timeElements = array(
			sprintf("%02d", $_POST['meetingAt']['meridiem'] == 'pm' ? $_POST['meetingAt']['hour']+12 : $_POST['meetingAt']['hour']),
			sprintf("%02d", $_POST['meetingAt']['minute']),
			'00',
		);

		$meetingAt = implode('-', $dateElements) . ' ' . implode(':', $timeElements);

		/* Start Date/Time
		 */
		$dateElements = array(
			sprintf("%02d", $_POST['startAt']['year']),
			sprintf("%02d", $_POST['startAt']['month']),
			sprintf("%02d", $_POST['startAt']['day']),
		);

		$timeElements = array(
			sprintf("%02d", $_POST['startAt']['meridiem'] == 'pm' ? $_POST['startAt']['hour']+12 : $_POST['startAt']['hour']),
			sprintf("%02d", $_POST['startAt']['minute']),
			'00',
		);

		$startAt = implode('-', $dateElements) . ' ' . implode(':', $timeElements);

		/* End Date/Time
		 */
		$dateElements = array(
			sprintf("%02d", $_POST['endAt']['year']),
			sprintf("%02d", $_POST['endAt']['month']),
			sprintf("%02d", $_POST['endAt']['day']),
		);

		$timeElements = array(
			sprintf("%02d", $_POST['endAt']['meridiem'] == 'pm' ? $_POST['endAt']['hour']+12 : $_POST['endAt']['hour']),
			sprintf("%02d", $_POST['endAt']['minute']),
			'00',
		);

		$endAt = implode('-', $dateElements) . ' ' . implode(':', $timeElements);

		/* Event
		 */
		$eventMapper = new EventMapper();

		$event = $eventMapper->findDetailedById($_POST['eventId']);
		$event->setName($_POST['name']);
		$event->setBrief($_POST['brief']);
		$event->setDescription($_POST['description']);
		$event->setMeetingAt($meetingAt);
		$event->setStartAt($startAt);
		$event->setEndAt($endAt);
		$event->setHidden(1);
		$event->setUpdatedAt($now);
		$event->setDeletedAt(null);

		$eventMapper = new EventMapper();
		$eventMapper->save($event);

		/* Purge waypoints before re-adding them and regenerating cached polyfills
		 */
		$waypointMapper = new WaypointMapper();

		foreach($event->getWaypoints() as $currentWaypoint) {
			$waypointMapper->delete($currentWaypoint);
		}

		$waypointCollection = new Collection();

		foreach($_POST['waypoint'] as $currentWaypoint) {
			$waypoint = new Waypoint();
			$waypoint->setEventId($event->getId());
			$waypoint->setAddress($currentWaypoint);
			$waypointMapper->save($waypoint);

			$waypointCollection->add($waypoint);
		}

		/* Render and cache polyfills
		 */
		$polyfills = new Waypoint\PolyfillCollection($waypointCollection);
		$polyfills->transcode();

		$routeMapper = new Waypoint\RouteMapper();
		$routeMapper->cleanse($event);

		$allPolyfills = $polyfills->getAllEncodedPolyfills();

		/* Save encoded polyfills, to save on remote requests
		 */
		foreach($allPolyfills as $currentPolyfill) {
			$route = new Waypoint\Route();
			$route->setEventId($event->getId());
			$route->setPolyfill($currentPolyfill->jsonSerialize());
			$routeMapper->save($route);
		}

		header("Location: /event/update/{$event->getId()}");
	}

	/**
	 * View special information about an event in a public context
	 */
	public function getEventToken() {
		$args = $this->getArgs();

		$eventMapper = new EventMapper();

		$event = $eventMapper->findByColumn('uuid', $args[1])->first();

		new Probe($event);

		exit();
	}

	/**
	 * Get a list of events
	 */
	public function getEventList() {
		$mapper = new UserMapper();

		$allUsers = $mapper->findAll();

		new Probe($allUsers);

		exit();
	}

	/**
	 * Detail view of a particular event
	 */
	public function getEventDetail() {
		$args = $this->getArgs();

		$eventMapper = new \Core\Event\EventMapper();
		$event = $eventMapper->findById($args[1]);

		$routes = new \Core\Event\Waypoint\RouteMapper();
		$allRoutes = $routes->findbyColumn('event_id', $args[1]);

		$event->setWaypoints($allRoutes);
new Probe($event->getWaypoints());
		$this->output('getEventDetail', array(
			'event' => $event,
		));
	}
}