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

		$this->addProperty('id', 'id', self::TYPE_INT);
		$this->addProperty('userId', 'user_id', self::TYPE_INT);
		$this->addProperty('username', 'username', self::TYPE_STR);
		$this->addProperty('password', 'password', self::TYPE_STR);
		$this->addProperty('avatar', 'avatar', self::TYPE_STR);
		$this->addProperty('activationDate', 'activation_date', self::TYPE_STR);
		$this->addProperty('expiryDate', 'expiry_date', self::TYPE_STR);
		$this->addProperty('lock', 'lock', self::TYPE_INT);

		$this->addProperty('createdAt', 'created_at', self::TYPE_STR);
		$this->addProperty('updatedAt', 'updated_at', self::TYPE_STR);
		$this->addProperty('deletedAt', 'deleted_at', self::TYPE_STR);
	}
} 