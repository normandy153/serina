<?php
/**
 * VehicleMapper.php
 *
 * Date: 29/04/2014
 * Time: 10:30 PM
 */

namespace Core\User;


class VehicleMapper extends \App\Mapper\Base {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User\\Vehicle');
		$this->setTable('vehicle');

		$this->addProperty('id', 'id', self::TYPE_INT);
		$this->addProperty('userId', 'user_id', self::TYPE_INT);
		$this->addProperty('registration', 'registration', self::TYPE_STR);
		$this->addProperty('passengers', 'passengers', self::TYPE_INT);
		$this->addProperty('description', 'description', self::TYPE_STR);

		$this->addTimestampable();
	}
} 