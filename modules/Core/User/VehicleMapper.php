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

		$this->addProperty('id', 'id');
		$this->addProperty('userId', 'user_id');
		$this->addProperty('registration', 'registration');
		$this->addProperty('passengers', 'passengers');
		$this->addProperty('description', 'description');

		$this->addProperty('createdAt', 'created_at');
		$this->addProperty('updatedAt', 'updated_at');
		$this->addProperty('deletedAt', 'deleted_at');
	}
} 