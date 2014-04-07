<?php
/**
 * AddressMapper.php
 *
 * Date: 7/04/2014
 * Time: 11:24 PM
 */

namespace Core\User;


class AddressMapper extends \App\Mapper {

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User\\Address');
		$this->setTable('address');

		$this->addProperty('id', 'id');
		$this->addProperty('address1', 'address1');
		$this->addProperty('address2', 'address2');
		$this->addProperty('suburb', 'suburb');
		$this->addProperty('state', 'state');
		$this->addProperty('postcode', 'postcode');
		$this->addProperty('country', 'country');

		$this->addProperty('createdAt', 'created_at');
		$this->addProperty('updatedAt', 'updated_at');
		$this->addProperty('deletedAt', 'deleted_at');
	}
} 