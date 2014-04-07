<?php
/**
 * StateMapper.php
 *
 * Date: 8/04/2014
 * Time: 12:19 AM
 */

namespace Core\User;


class StateMapper extends \App\Mapper {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User\\State');
		$this->setTable('state');

		$this->addProperty('id', 'id');
		$this->addProperty('name', 'name');
		$this->addProperty('abbreviation', 'abbreviation');
	}
} 