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
		 *
		 * The 'collection' key is the database column into
		 * which the final joined collections are placed
		 */
		$this->addJoin('Phone', array(
			'this' => array(
				'model' => '\Core\User\User',
				'key' => 'id',
				'collection' => 'phone_id',
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
				'collection' => 'address_id',
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

		/* Use cached mapper spawns
		 */
		$userMapper = $query->getMapper('\Core\User\User', 'u');
		$addressMapper = $query->getMapper('\Core\User\Address', 'a');
		$stateMapper = $query->getMapper('\Core\User\State', 's');
		$phoneMapper = $query->getMapper('\Core\User\Phone', 'p');

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
		$this->joinCollections($addressCollection, $stateCollection, 'State', $query);

		/* Build user/address relation
		 */
		$this->joinCollections($userCollection, $addressCollection, 'Address', $query);

		/* Build user/phone relation
		 */
		$this->joinCollections($userCollection, $phoneCollection, 'Phone', $query);

		return $userCollection;
	}

	/**
	 * Join two collections using the rule $rule used in $query
	 *
	 * @param $collection1
	 * @param $collection2
	 * @param $rule
	 * @param $query
	 * @throws \Exception
	 */
	private function joinCollections($collection1, $collection2, $rule, $query) {
		$rules = $query->getRules();

		$useRule = false;
		$getter1 = false;
		$getter2 = false;

		foreach($rules as $currentRule) {
			if ($currentRule['name'] == $rule) {
				$useRule = $currentRule['rule'];

				/* Find stuff in $collection1 using this key
				 */
				$key1 = $useRule['this']['key'];

				/* Find stuff from $collection2 using this key
				 */
				$key2 = $useRule['other']['key'];

				/* Stuff from $collection2 gets dumped into $key1
 				 */
				$key3 = $useRule['this']['collection'];

				/* Set the resultant collection of $collection2 items
				 * into items from $collection1
				 */
				$setter = $query->deriveSetterMethodFromColumn($key3, $useRule['this']['model'] . 'Mapper');

				/* Used to compare keys for matching items
				 */
				$getter1 = $query->deriveGetterMethodFromColumn($key1, $useRule['this']['model'] . 'Mapper');
				$getter2 = $query->deriveGetterMethodFromColumn($key2, $useRule['other']['model'] . 'Mapper');

				break;
			}
		}

		/* Proceed if all bits are found
		 */
		if ($useRule && $getter1 && $getter2) {
			$allKeys = array_keys($collection1->getStack());

			foreach($allKeys as $currentKey) {
				$final = new \App\Collection();

				$rootNode = $collection1->getItemAt($currentKey);
				$collection2->reindex();

				foreach($collection2 as $current) {
					if ($rootNode->$getter1() == $current->$getter2()) {
						$final->add($current);
					}
				}

				$rootNode->$setter($final);
			}
		}
		else {
			throw new \Exception('Join rule not found.');
		}
	}
} 