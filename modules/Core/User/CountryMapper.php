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

		$this->addProperty('id', 'id');
		$this->addProperty('name', 'name');
		$this->addProperty('abbreviation', 'abbreviation');
	}
} 