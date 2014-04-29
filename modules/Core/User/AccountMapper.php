<?php
/**
 * AccountMapper.php
 *
 * Date: 30/04/2014
 * Time: 12:10 AM
 */

namespace Core\User;


class AccountMapper extends \App\Mapper\Base {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User\\Account');
		$this->setTable('account');

		$this->addProperty('id', 'id');
		$this->addProperty('userId', 'user_id');
		$this->addProperty('username', 'username');
		$this->addProperty('password', 'password');
		$this->addProperty('avatar', 'avatar');
		$this->addProperty('activationDate', 'activation_date');
		$this->addProperty('expiryDate', 'expiry_date');
		$this->addProperty('lock', 'lock');

		$this->addProperty('createdAt', 'created_at');
		$this->addProperty('updatedAt', 'updated_at');
		$this->addProperty('deletedAt', 'deleted_at');
	}
} 