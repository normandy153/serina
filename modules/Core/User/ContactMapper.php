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

		$this->addProperty('id', 'id', \PDO::PARAM_INT);
		$this->addProperty('userId', 'user_id', \PDO::PARAM_INT);
		$this->addProperty('firstname', 'firstname', \PDO::PARAM_STR);
		$this->addProperty('lastname', 'lastname', \PDO::PARAM_STR);
		$this->addProperty('phone', 'phone', \PDO::PARAM_STR);
		$this->addProperty('notes', 'notes', \PDO::PARAM_STR);

		$this->addProperty('createdAt', 'created_at', \PDO::PARAM_STR);
		$this->addProperty('updatedAt', 'updated_at', \PDO::PARAM_STR);
		$this->addProperty('deletedAt', 'deleted_at', \PDO::PARAM_STR);
	}
} 