<?php
/**
 * PhoneTypeMapper.php
 *
 * Date: 22/05/2014
 * Time: 11:07 PM
 */

namespace Core\User;


class PhoneTypeMapper extends \App\Mapper\Base {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User\\PhoneType');
		$this->setTable('phonetype');

		$this->addProperty('id', 'id', self::TYPE_INT);
		$this->addProperty('name', 'name', self::TYPE_STR);
	}
} 