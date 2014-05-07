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

		$this->addProperty('id', 'id', \PDO::PARAM_INT);
		$this->addProperty('name', 'name', \PDO::PARAM_STR);
		$this->addProperty('abbreviation', 'abbreviation', \PDO::PARAM_STR);
	}
} 