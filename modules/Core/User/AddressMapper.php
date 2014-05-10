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

		$this->addProperty('id', 'id', self::TYPE_INT);
		$this->addProperty('address1', 'address1', self::TYPE_STR);
		$this->addProperty('address2', 'address2', self::TYPE_STR);
		$this->addProperty('suburb', 'suburb', self::TYPE_STR);
		$this->addProperty('state', 'state', self::TYPE_INT);
		$this->addProperty('postcode', 'postcode', self::TYPE_STR);
		$this->addProperty('country', 'country', self::TYPE_INT);

		$this->addProperty('createdAt', 'created_at', self::TYPE_STR);
		$this->addProperty('updatedAt', 'updated_at', self::TYPE_STR);
		$this->addProperty('deletedAt', 'deleted_at', self::TYPE_STR);

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