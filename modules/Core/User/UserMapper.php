<?php
/**
 * UserMapper.php
 *
 * Date: 7/04/2014
 * Time: 9:37 PM
 */

namespace Core\User;
use \App\Mapper\Query as Query;

class UserMapper extends \App\Mapper\Base {

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
		$this->addProperty('email', 'email');
		$this->addProperty('gender', 'gender_id');

		/* Join the Phone record onto the User record using
		 * the following columns as a match. 'other' model and
		 * key refer to the table (via corresponding mapper)
		 * being joined onto 'this' model
		 *
		 * These definitions, when combined into the final
		 * sql query, mustn't create a syntactically incorrect
		 * query, or it'll just snap
		 *
		 * The 'collection' key is the database column into
		 * which the final joined collections are placed and
		 * applies only to the model/mapper specified in 'this'
		 */
		$this->addJoin('Phone', array(
			'this' => array(
				'mapper' => '\Core\User\UserMapper',
				'key' => 'id',
				'collection' => 'phone_id',
			),
			'other' => array(
				'mapper' => '\Core\User\PhoneMapper',
				'key' => 'user_id',
			),
		));

		$this->addJoin('Address', array(
			'this' => array(
				'mapper' => '\Core\User\UserMapper',
				'key' => 'address_id',
				'collection' => 'address_id',
			),
			'other' => array(
				'mapper' => '\Core\User\AddressMapper',
				'key' => 'id',
			),
		));

		$this->addJoin('Gender', array(
			'this' => array(
				'mapper' => '\Core\User\UserMapper',
				'key' => 'gender_id',
				'collection' => 'gender_id',
			),
			'other' => array(
				'mapper' => '\Core\User\GenderMapper',
				'key' => 'id',
			)
		));

		$this->addJoin('Email', array(
			'this' => array(
				'mapper' => '\Core\User\UserMapper',
				'key' => 'id',
				'collection' => 'email',
			),
			'other' => array(
				'mapper' => '\Core\User\EmailMapper',
				'key' => 'user_id',
			),
		));
	}

	/**
	 * Find all the users with all their extra data
	 */
	public function findAll() {
		$query = new Query();
		$query->select(
			'\Core\User\User u',
			'\Core\User\Address a',
			'\Core\User\State s',
			'\Core\User\Country c',
			'\Core\User\Phone p',
			'\Core\User\Email e',
			'\Core\User\Gender g'
		)
			->from('u')
			->leftJoin('u', 'Address', 'a')
			->leftJoin('a', 'State', 's')
			->leftJoin('a', 'Country', 'c')
			->leftJoin('u', 'Phone', 'p')
			->leftJoin('u', 'Email', 'e')
			->leftJoin('u', 'Gender', 'g')
			->where('u.id = :userId')
			->orWhere('p.id = :phoneId')
			->prepare();

		$statement = $query->execute(array(
			':userId' => 1,
			':phoneId' => 3
		));

		/* Set up collections
		 */
		$userCollection = new \App\Collection();
		$addressCollection = new \App\Collection();
		$stateCollection = new \App\Collection();
		$countryCollection = new \App\Collection();
		$phoneCollection = new \App\Collection();
		$emailCollection = new \App\Collection();
		$genderCollection = new \App\Collection();

		foreach($statement as $row) {
			$user = $query->getMapperForAlias('u')->hydrate('u', $row);
			$userCollection->setItemAt($user->getId(), $user);

			$address = $query->getMapperForAlias('a')->hydrate('a', $row);
			$addressCollection->setItemAt($address->getId(), $address);

			$state = $query->getMapperForAlias('s')->hydrate('s', $row);
			$stateCollection->setItemAt($state->getId(), $state);

			$country = $query->getMapperForAlias('c')->hydrate('c', $row);
			$countryCollection->setItemAt($country->getId(), $country);
			
			$phone = $query->getMapperForAlias('p')->hydrate('p', $row);
			$phoneCollection->setItemAt($phone->getId(), $phone);

			$email = $query->getMapperForAlias('e')->hydrate('e', $row);
			$emailCollection->setItemAt($email->getId(), $email);

			$gender = $query->getMapperForAlias('g')->hydrate('g', $row);
			$genderCollection->setItemAt($gender->getId(), $gender);
		}

		/* Build address/country relation
 		 */
		$this->joinCollections($addressCollection, $countryCollection, 'Country', $query);

		/* Build address/state relation
		 */
		$this->joinCollections($addressCollection, $stateCollection, 'State', $query);

		/* Build user/address relation
		 */
		$this->joinCollections($userCollection, $addressCollection, 'Address', $query);

		/* Build user/phone relation
		 */
		$this->joinCollections($userCollection, $phoneCollection, 'Phone', $query);

		/* Build user/email relation
 		 */
		$this->joinCollections($userCollection, $emailCollection, 'Email', $query);

		/* Build user/gender relation
		 */
		$this->joinCollections($userCollection, $genderCollection, 'Gender', $query);

		/* Reindex
		 */
		$userCollection->reindex();

		return $userCollection;
	}
} 