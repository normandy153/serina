<?php
/**
 * Event
 *
 * Date: 14/01/2014
 * Time: 11:46 PM
 */

namespace Core\Event\Domain\Unrestricted;

use App\Controller\Domain\Unrestricted;
use App\Probe;
use Core\Event\Event;
use Core\Event\EventMapper;

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
		$event->setCreatedAt($now);
		$event->setUpdatedAt($now);
		$event->setDeletedAt(null);

		$eventMapper = new EventMapper();
		$eventMapper->save($event);

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

		$this->output('getEventDetail', array(
			'event' => $event
		));
	}
}