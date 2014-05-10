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

		$this->addProperty('id', 'id', self::TYPE_INT);
		$this->addProperty('userId', 'user_id', self::TYPE_INT);
		$this->addProperty('firstname', 'firstname', self::TYPE_STR);
		$this->addProperty('lastname', 'lastname', self::TYPE_STR);
		$this->addProperty('phone', 'phone', self::TYPE_STR);
		$this->addProperty('notes', 'notes', self::TYPE_STR);

		$this->addProperty('createdAt', 'created_at', self::TYPE_STR);
		$this->addProperty('updatedAt', 'updated_at', self::TYPE_STR);
		$this->addProperty('deletedAt', 'deleted_at', self::TYPE_STR);
	}
} 