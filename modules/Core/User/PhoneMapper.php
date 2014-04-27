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

		$this->addProperty('id', 'id');
		$this->addProperty('userId', 'user_id');
		$this->addProperty('typeId', 'type_id');
		$this->addProperty('number', 'number');

		$this->addProperty('createdAt', 'created_at');
		$this->addProperty('updatedAt', 'updated_at');
		$this->addProperty('deletedAt', 'deleted_at');
	}
} 