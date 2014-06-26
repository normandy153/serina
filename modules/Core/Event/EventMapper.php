<?php
/**
 * EventMapper.php
 *
 * Date: 9/06/2014
 * Time: 4:16 PM
 */

namespace Core\Event;
use \App\Mapper\Query as Query;

class EventMapper extends \App\Mapper\Base {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\Event\\Event');
		$this->setTable('event');

		$this->addProperty('id', 'id', self::TYPE_INT);
		$this->addProperty('uuid', 'uuid', self::TYPE_STR);
		$this->addProperty('name', 'name', self::TYPE_STR);
		$this->addProperty('brief', 'brief', self::TYPE_STR);
		$this->addProperty('description', 'description', self::TYPE_STR);
		$this->addProperty('meetingAt', 'meeting_at', self::TYPE_STR);
		$this->addProperty('startAt', 'start_at', self::TYPE_STR);
		$this->addProperty('endAt', 'end_at', self::TYPE_STR);
		$this->addProperty('hidden', 'hidden', self::TYPE_INT);

		/* Collections joined into this object
		 */
		$this->addProperty('waypoints', null, self::TYPE_COLLECTION);
//		$this->addProperty('routes', null, self::TYPE_COLLECTION);
//		$this->addProperty('attendees', null, self::TYPE_COLLECTION);

		$this->addJoin('Waypoint', array(
			'this' => array(
				'mapper' => '\Core\Event\EventMapper',
				'property' => 'id',
				'collection' => 'waypoints',
			),
			'other' => array(
				'mapper' => '\Core\Event\WaypointMapper',
				'property' => 'eventId',
			),
		));

		$this->addTimestampable();
	}

	/**
	 * Find detailed information about an event
	 *
	 * @param $id
	 * @return mixed
	 */
	public function findDetailedById($id) {
		$query = new Query();
		$query->select(
			'\Core\Event\Event e',
			'\Core\Event\Waypoint w'
		)
			->from('e')
			->leftJoin('e', 'Waypoint', 'w')
			->where('e.id = :id')
			->prepare();

		/* Parameters used in the query
		 */
		$parameters = array(
			'id' => array(
				'column' => $id,
				'type' => self::TYPE_INT,
			)
		);

		$statement = $query->execute($parameters);

		/* Set up collections
		 */
		$eventCollection = new \App\Collection();
		$waypointCollection = new \App\Collection();

		foreach($statement as $row) {
			$event = $query->getMapperForAlias('e')->hydrate('e', $row);
			$eventCollection->setItemAt($event->getId(), $event);

			$waypoint = $query->getMapperForAlias('w')->hydrate('w', $row);
			$waypointCollection->setItemAt($waypoint->getId(), $waypoint);
		}

		/* Build event/waypoint relation
 		 */
		$this->joinCollections($eventCollection, $waypointCollection, 'Waypoint', $query);

		/* Reindex
		 */
		$eventCollection->reindex();

		return $eventCollection->first();
	}
} 