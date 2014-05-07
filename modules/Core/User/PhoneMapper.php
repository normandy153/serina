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

		$this->addProperty('id', 'id', \PDO::PARAM_INT);
		$this->addProperty('userId', 'user_id', \PDO::PARAM_INT);
		$this->addProperty('typeId', 'type_id', \PDO::PARAM_INT);
		$this->addProperty('number', 'number', \PDO::PARAM_STR);

		$this->addProperty('createdAt', 'created_at', \PDO::PARAM_STR);
		$this->addProperty('updatedAt', 'updated_at', \PDO::PARAM_STR);
		$this->addProperty('deletedAt', 'deleted_at', \PDO::PARAM_STR);
	}
} 