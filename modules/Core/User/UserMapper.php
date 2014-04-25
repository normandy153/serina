<?php
/**
 * UserMapper.php
 *
 * Date: 7/04/2014
 * Time: 9:37 PM
 */

namespace Core\User;
use \App\Mapper\Query as Query;

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
		$this->addProperty('address', 'address_id');
		$this->addProperty('phone', 'phone_id');

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
		$query = new Query();
		$query->select('\Core\User\User u', '\Core\User\Address a', '\Core\User\State s', '\Core\User\Phone p')
			->from('\Core\User\User u')
			->leftJoin('\Core\User\User u', 'Address a')
			->leftJoin('\Core\User\Address a', 'State s')
			->leftJoin('\Core\User\User u', 'Phone p');

		$statement = $this->getDatabase()->prepare($query->prepare());
		$statement->execute();

		$objectGraph = $query->getObjectGraph();

		/* Use cached mapper spawns
		 */
		$userMapper = $query->getMapper('\Core\User\User', 'u');
		$addressMapper = $query->getMapper('\Core\User\Address', 'a');
		$stateMapper = $query->getMapper('\Core\User\State', 's');
		$phoneMapper = $query->getMapper('\Core\User\Phone', 'p');

		$graph = new \App\Collection();

		$userCollection = new \App\Collection();
		$addressCollection = new \App\Collection();
		$stateCollection = new \App\Collection();
		$phoneCollection = new \App\Collection();

		foreach($statement as $row) {
			$user = $userMapper->hydrate('u', $row);
			$userCollection->setItemAt($user->getId(), $user);

			$address = $addressMapper->hydrate('a', $row);
			$addressCollection->setItemAt($address->getId(), $address);

			$state = $stateMapper->hydrate('s', $row);
			$stateCollection->setItemAt($state->getId(), $state);

			$phone = $phoneMapper->hydrate('p', $row);
			$phoneCollection->setItemAt($phone->getId(), $phone);
		}

		/* Build address/state relation
		 */
		$allKeys = array_keys($addressCollection->getStack());

		foreach($allKeys as $currentKey) {
			$collection = new \App\Collection();

			$address = $addressCollection->getItemAt($currentKey);
			$stateCollection->reindex();

			foreach($stateCollection as $current) {
				if ($current->getId() == $address->getState()) {
					$collection->add($current);
				}
			}

			$address->setState($collection);
		}

		/* Build user/address relation
		 */
		$allKeys = array_keys($userCollection->getStack());

		foreach($allKeys as $currentKey) {
			$collection = new \App\Collection();

			$user = $userCollection->getItemAt($currentKey);
			$addressCollection->reindex();

			foreach($addressCollection as $current) {
				if ($current->getId() == $user->getAddress()) {
					$collection->add($current);
				}
			}

			$user->setAddress($collection);
		}

		/* Build user/phone relation
		 */
		$allKeys = array_keys($userCollection->getStack());

		foreach($allKeys as $currentKey) {
			$collection = new \App\Collection();

			$user = $userCollection->getItemAt($currentKey);
			$phoneCollection->reindex();

			foreach($phoneCollection as $current) {
				if ($current->getUserId() == $user->getId()) {
					$collection->add($current);
				}
			}

			$user->setPhone($collection);
		}

		new \App\Probe($userCollection);
	}
} 