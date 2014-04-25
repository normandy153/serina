<?php
/**
 * Event
 *
 * Date: 14/01/2014
 * Time: 11:46 PM
 */

namespace Core\Event\Domain\Unrestricted;


class Controller extends \App\Controller\Domain\Unrestricted {

	/**
	 * Get a list of events
	 */
	public function getEventList() {
		$mapper = new \Core\User\UserMapper();

		$mapper->findAll();

		exit();
	}

	/**
	 * Detail view of a particular event
	 */
	public function getEventDetail() {
		$event = new \Core\Event();

		$this->output('getEventDetail', array(
			'event' => $event
		));
	}
}