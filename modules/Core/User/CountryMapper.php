<?php
/**
 * CountryMapper.php
 *
 * Date: 8/04/2014
 * Time: 10:46 PM
 */

namespace Core\User;


class CountryMapper extends \App\Mapper\Base {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User\\Country');
		$this->setTable('country');

		$this->addProperty('id', 'id', self::TYPE_INT);
		$this->addProperty('name', 'name', self::TYPE_STR);
		$this->addProperty('abbreviation', 'abbreviation', self::TYPE_STR);
	}
} 