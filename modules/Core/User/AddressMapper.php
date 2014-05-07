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

		$this->addProperty('id', 'id', \PDO::PARAM_INT);
		$this->addProperty('address1', 'address1', \PDO::PARAM_STR);
		$this->addProperty('address2', 'address2', \PDO::PARAM_STR);
		$this->addProperty('suburb', 'suburb', \PDO::PARAM_STR);
		$this->addProperty('state', 'state', \PDO::PARAM_INT);
		$this->addProperty('postcode', 'postcode', \PDO::PARAM_STR);
		$this->addProperty('country', 'country', \PDO::PARAM_INT);

		$this->addProperty('createdAt', 'created_at', \PDO::PARAM_STR);
		$this->addProperty('updatedAt', 'updated_at', \PDO::PARAM_STR);
		$this->addProperty('deletedAt', 'deleted_at', \PDO::PARAM_STR);

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