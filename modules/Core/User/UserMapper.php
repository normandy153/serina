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
			'other' => array(
				'table' => 'phone',
				'alias' => 'p',
				'key' => 'user_id',
			),
			'this' => array(
				'alias' => 'u',
				'key' => 'id',
			)
		));

		$this->addJoin('Address', array(
			'other' => array(
				'table' => 'address',
				'alias' => 'a',
				'key' => 'id',
			),
			'this' => array(
				'alias' => 'u',
				'key' => 'address_id',
			)
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

//		$query = "
//			SELECT
//				{$userMapper->select('u')},
//				{$addressMapper->select('a')},
//				{$stateMapper->select('s')},
//				{$phoneMapper->select('p')}
//			{$userMapper->from('User', 'u')}
//			{$userMapper->join('Address', 'a')}
//			{$addressMapper->join('State', 's')}
//			{$userMapper->join('Phone', 'p')}
//		";

		$query = new \App\Mapper\Query();
		$query->select('\Core\User\User u', '\Core\User\Address a', '\Core\User\State s', '\Core\User\Phone p')
			->from('\Core\User\User u');


//		$query
//			->select('User u', 'Address a', 'State s', 'Phone p')
//			->from('u')
//			->join('User Address')
//			->join('Address State')
//			->join('User Phone')
//			->execute();


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