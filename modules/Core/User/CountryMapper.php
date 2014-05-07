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

		$this->addProperty('id', 'id', \PDO::PARAM_INT);
		$this->addProperty('name', 'name', \PDO::PARAM_STR);
		$this->addProperty('abbreviation', 'abbreviation', \PDO::PARAM_STR);
	}
} 