<?php
/**
 * UserMapper.php
 *
 * Date: 7/04/2014
 * Time: 9:37 PM
 */

namespace Core\User;


class UserMapper extends \App\Mapper {

	protected $finalGraph = array();

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User');
		$this->setTable('user');

		$this->addProperty('id', 'id');
		$this->addProperty('uuid', 'uuid');
		$this->addProperty('firstname', 'firstname');
		$this->addProperty('lastname', 'lastname');
		$this->addProperty('birthdate', 'birthdate');

		/* Join the Phone record onto the User record using
		 * the following columns as a match. otherTable and
		 * otherKey refer to the table and key being joined
		 * onto this current mapper's model
		 *
		 * These definitions, when combined into the final
		 * sql query, mustn't create a syntactically incorrect
		 * query, or it'll just snap
		 */
		$this->addJoin('Phone', array(
			'this' => array(
				'model' => '\Core\User\User',
				'key' => 'id',
			),
			'other' => array(
				'model' => '\Core\User\Phone',
				'key' => 'user_id',
			),
		));

		$this->addJoin('Address', array(
			'this' => array(
				'model' => '\Core\User\User',
				'key' => 'address_id',
			),
			'other' => array(
				'model' => '\Core\User\Address',
				'key' => 'id',
			),
		));
	}

	/**
	 * TODO: Test method
	 */
	public function testQuery() {
		$userMapper = $this;
		$addressMapper = new \Core\User\AddressMapper();
		$stateMapper = new \Core\User\StateMapper();
		$phoneMapper = new \Core\User\PhoneMapper();

		$query = new \App\Mapper\Query();
		$query->select('\Core\User\User u', '\Core\User\Address a', '\Core\User\State s')
			->from('\Core\User\User u')
			->leftJoin('\Core\User\User u', 'Address', 'a')
			->innerJoin('\Core\User\Address a', 'State', 's')
			->innerJoin('\Core\User\User u', 'Phone', 'p');


		new \App\Probe($query);
		$statement = $this->getDatabase()->prepare($query);
		$statement->execute();

		foreach($statement as $row) {
			$user = $userMapper->hydrate('u', $row);
			$address = $addressMapper->hydrate('a', $row);
			$state = $stateMapper->hydrate('s', $row);
			$phone = $phoneMapper->hydrate('p', $row);

			$rowCollection = new \App\Collection();
			$rowCollection->add($user);
			$rowCollection->add($address);
			$rowCollection->add($state);
			$rowCollection->add($phone);

			$this->build($rowCollection);
		}

//		new \App\Probe($rowCollection);
	}
} 