<?php
/**
 * VehicleMapper.php
 *
 * Date: 29/04/2014
 * Time: 10:30 PM
 */

namespace Core\User;


class VehicleMapper extends \App\Mapper\Base {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User\\Vehicle');
		$this->setTable('vehicle');

		$this->addProperty('id', 'id', \PDO::PARAM_INT);
		$this->addProperty('userId', 'user_id', \PDO::PARAM_INT);
		$this->addProperty('registration', 'registration', \PDO::PARAM_STR);
		$this->addProperty('passengers', 'passengers', \PDO::PARAM_INT);
		$this->addProperty('description', 'description', \PDO::PARAM_STR);

		$this->addProperty('createdAt', 'created_at', \PDO::PARAM_STR);
		$this->addProperty('updatedAt', 'updated_at', \PDO::PARAM_STR);
		$this->addProperty('deletedAt', 'deleted_at', \PDO::PARAM_STR);
	}
} 