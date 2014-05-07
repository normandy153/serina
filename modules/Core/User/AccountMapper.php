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

		$this->addProperty('id', 'id', \PDO::PARAM_INT);
		$this->addProperty('userId', 'user_id', \PDO::PARAM_INT);
		$this->addProperty('username', 'username', \PDO::PARAM_STR);
		$this->addProperty('password', 'password', \PDO::PARAM_STR);
		$this->addProperty('avatar', 'avatar', \PDO::PARAM_STR);
		$this->addProperty('activationDate', 'activation_date', \PDO::PARAM_STR);
		$this->addProperty('expiryDate', 'expiry_date', \PDO::PARAM_STR);
		$this->addProperty('lock', 'lock', \PDO::PARAM_INT);

		$this->addProperty('createdAt', 'created_at', \PDO::PARAM_STR);
		$this->addProperty('updatedAt', 'updated_at', \PDO::PARAM_STR);
		$this->addProperty('deletedAt', 'deleted_at', \PDO::PARAM_STR);
	}
} 