<?php
/**
 * ContactMapper.php
 *
 * Date: 29/04/2014
 * Time: 11:26 PM
 */

namespace Core\User;


class ContactMapper extends \App\Mapper\Base {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User\\Contact');
		$this->setTable('contact');

		$this->addProperty('id', 'id');
		$this->addProperty('userId', 'user_id');
		$this->addProperty('firstname', 'firstname');
		$this->addProperty('lastname', 'lastname');
		$this->addProperty('phone', 'phone');
		$this->addProperty('notes', 'notes');

		$this->addProperty('createdAt', 'created_at');
		$this->addProperty('updatedAt', 'updated_at');
		$this->addProperty('deletedAt', 'deleted_at');
	}
} 