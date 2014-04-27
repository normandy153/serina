<?php
/**
 * AddressMapper.php
 *
 * Date: 7/04/2014
 * Time: 11:24 PM
 */

namespace Core\User;


class AddressMapper extends \App\Mapper\Base {

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

		$this->addJoin('State', array(
			'this' => array(
				'mapper' => '\Core\User\AddressMapper',
				'key' => 'state',
				'collection' => 'state',
			),
			'other' => array(
				'mapper' => '\Core\User\StateMapper',
				'key' => 'id',
			),
		));

		$this->addJoin('Country', array(
			'this' => array(
				'mapper' => '\Core\User\AddressMapper',
				'key' => 'country',
				'collection' => 'country',
			),
			'other' => array(
				'mapper' => '\Core\User\CountryMapper',
				'key' => 'id',
			),
		));
	}
} 