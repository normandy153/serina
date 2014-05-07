<?php
/**
 * EmailMapper.php
 *
 * Date: 26/04/2014
 * Time: 5:38 AM
 */

namespace Core\User;


class EmailMapper extends \App\Mapper\Base {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User\\Email');
		$this->setTable('email');

		$this->addProperty('id', 'id', \PDO::PARAM_INT);
		$this->addProperty('userId', 'user_id', \PDO::PARAM_INT);
		$this->addProperty('address', 'address', \PDO::PARAM_STR);

		$this->addProperty('createdAt', 'created_at', \PDO::PARAM_STR);
		$this->addProperty('updatedAt', 'updated_at', \PDO::PARAM_STR);
		$this->addProperty('deletedAt', 'deleted_at', \PDO::PARAM_STR);
	}
}