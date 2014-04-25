<?php
/**
 * EmailMapper.php
 *
 * Date: 26/04/2014
 * Time: 5:38 AM
 */

namespace Core\User;


class EmailMapper extends \App\Mapper {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User\\Email');
		$this->setTable('email');

		$this->addProperty('id', 'id');
		$this->addProperty('userId', 'user_id');
		$this->addProperty('address', 'address');

		$this->addProperty('createdAt', 'created_at');
		$this->addProperty('updatedAt', 'updated_at');
		$this->addProperty('deletedAt', 'deleted_at');
	}
}