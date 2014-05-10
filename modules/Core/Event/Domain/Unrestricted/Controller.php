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
use Core\Event;
use Core\User\UserMapper;

class Controller extends Unrestricted {

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
		$event = new Event();

		$this->output('getEventDetail', array(
			'event' => $event
		));
	}
}