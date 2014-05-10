<?php
/**
 * PhoneMapper.php
 *
 * Date: 8/04/2014
 * Time: 11:24 PM
 */

namespace Core\User;


class PhoneMapper extends \App\Mapper\Base {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User\\Phone');
		$this->setTable('phone');

		$this->addProperty('id', 'id', self::TYPE_INT);
		$this->addProperty('userId', 'user_id', self::TYPE_INT);
		$this->addProperty('typeId', 'type_id', self::TYPE_INT);
		$this->addProperty('number', 'number', self::TYPE_STR);

		$this->addTimestampable();
	}
} 