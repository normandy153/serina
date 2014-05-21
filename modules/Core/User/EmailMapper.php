<?php
/**
 * EmailMapper.php
 *
 * Date: 26/04/2014
 * Time: 5:38 AM
 */

namespace Core\User;


class EmailMapper extends \App\Mapper\Base {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User\\Email');
		$this->setTable('email');

		$this->addProperty('id', 'id', self::TYPE_INT);
		$this->addProperty('userId', 'user_id', self::TYPE_INT);
		$this->addProperty('address', 'address', self::TYPE_STR);

		$this->addTimestampable();
	}
}