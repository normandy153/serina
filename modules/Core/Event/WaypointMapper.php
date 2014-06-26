<?php
/**
 * WaypointMapper.php
 *
 * Date: 26/06/2014
 * Time: 9:09 PM
 */

namespace Core\Event;
use \App\Mapper\Query as Query;

class WaypointMapper extends \App\Mapper\Base {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\Event\\Waypoint');
		$this->setTable('waypoint');

		$this->addProperty('id', 'id', self::TYPE_INT);
		$this->addProperty('eventId', 'event_id', self::TYPE_INT);
		$this->addProperty('address', 'address', self::TYPE_STR);
	}
}