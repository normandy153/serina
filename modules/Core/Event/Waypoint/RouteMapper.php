<?php
/**
 * RouteMapper.php
 *
 * Date: 3/07/2014
 * Time: 12:07 AM
 */

namespace Core\Event\Waypoint;


class RouteMapper extends \App\Mapper\Base {

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
	}

	public function cleanse($event) {
		$queryString = "
			DELETE FROM `{$this->getTable()}`
			WHERE event_id = :eventId
		";

		$query = new \App\Mapper\Query();
		$query->prepareRawQuery($queryString);
		$query->execute(array(
			'eventId' => array(
				'column' => $event->getId(),
				'type' => self::TYPE_INT,
			)
		));
	}
} 