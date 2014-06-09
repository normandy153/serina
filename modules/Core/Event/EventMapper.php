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
		$this->addProperty('routes', null, self::TYPE_COLLECTION);
		$this->addProperty('attendees', null, self::TYPE_COLLECTION);

		$this->addTimestampable();
	}
} 