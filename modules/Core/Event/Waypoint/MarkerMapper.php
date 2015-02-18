<?php
/**
 * MarkerMapper.php
 *
 * Date: 18/02/2015
 * Time: 11:32 PM
 */

namespace Core\Event\Waypoint;

use \App\Mapper\Query;
use \App\Mapper\Base;

class MarkerMapper extends Base {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\Event\\Waypoint\\Marker');
		$this->setTable('marker');

		$this->addProperty('id', 'id', self::TYPE_INT);
		$this->addProperty('eventId', 'event_id', self::TYPE_INT);
		$this->addProperty('latitude', 'latitude', self::TYPE_STR);
		$this->addProperty('longitude', 'longitude', self::TYPE_STR);
		$this->addProperty('description', 'description', self::TYPE_STR);
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