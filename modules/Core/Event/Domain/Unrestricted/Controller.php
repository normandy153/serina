<?php
/**
 * Event
 *
 * Date: 14/01/2014
 * Time: 11:46 PM
 */

namespace Core\Event\Domain\Unrestricted;


use App\Controller\Domain\Unrestricted;
use App\Date\Dropdown;
use App\Probe;
use Core\Event;
use Core\User\UserMapper;

class Controller extends Unrestricted {

	public function getEventCreate() {
		$dropdown = new Dropdown();
		$dropdown->setMinYearOffset(0);
		$dropdown->setPreselectedYear(date('Y'));
		$dropdown->setPreselectedMonth(date('n'));
		$dropdown->setPreselectedDay(date('j'));

		$this->output('getEventCreate', array(
			'allDates' => $dropdown->generate(),
		));
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