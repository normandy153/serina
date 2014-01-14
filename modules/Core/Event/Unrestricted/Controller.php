<?php
/**
 * Event
 *
 * Date: 14/01/2014
 * Time: 11:46 PM
 */

namespace Core\Event\Unrestricted;


class Controller extends \App\Controller\Type\Unrestricted {

	/**
	 * Detail view of a particular event
	 */
	public function getEventDetail() {
		$event = new \Core\Event();

		$this->output('getEventDetail', array(
			'collection' => array(
				$event
			)
		));
	}
}