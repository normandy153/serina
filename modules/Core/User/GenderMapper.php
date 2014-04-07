<?php
/**
 * GenderMapper.php
 *
 * Date: 7/04/2014
 * Time: 10:27 PM
 */

namespace Core\User;


class GenderMapper extends \App\Mapper {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User\\Gender');
		$this->setTable('gender');

		$this->addProperty('id', 'id');
		$this->addProperty('name', 'name');
		$this->addProperty('abbreviation', 'abbreviation');
	}
} 