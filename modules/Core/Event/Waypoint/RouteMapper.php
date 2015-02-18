<?php
/**
 * RouteMapper.php
 *
 * Date: 3/07/2014
 * Time: 12:07 AM
 */

namespace Core\Event\Waypoint;

use \App\Mapper\Query;
use \App\Mapper\Base;

class RouteMapper extends Base {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\Event\\Waypoint\\Route');
		$this->setTable('route');

		$this->addProperty('id', 'id', self::TYPE_INT);
		$this->addProperty('eventId', 'event_id', self::TYPE_INT);
		$this->addProperty('polyfill', 'polyfill', self::TYPE_STR);
		$this->addProperty('bounds', 'bounds', self::TYPE_STR);
	}

	/**
	 * Delete existing routes associated with an event
	 *
	 * @param $event
	 */
	public function cleanse($event) {
		$queryString = "
			DELETE FROM `{$this->getTable()}`
			WHERE event_id = :eventId
		";

		$query = new Query();
		$query->prepareRawQuery($queryString);
		$query->execute(array(
			'eventId' => array(
				'column' => $event->getId(),
				'type' => self::TYPE_INT,
			)
		));
	}
} 