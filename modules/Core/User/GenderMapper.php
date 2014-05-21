<?php
/**
 * GenderMapper.php
 *
 * Date: 7/04/2014
 * Time: 10:27 PM
 */

namespace Core\User;


class GenderMapper extends \App\Mapper\Base {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User\\Gender');
		$this->setTable('gender');

		$this->addProperty('id', 'id', self::TYPE_INT);
		$this->addProperty('name', 'name', self::TYPE_STR);
		$this->addProperty('abbreviation', 'abbreviation', self::TYPE_STR);
	}
} 