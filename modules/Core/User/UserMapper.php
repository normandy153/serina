<?php
/**
 * UserMapper.php
 *
 * Date: 7/04/2014
 * Time: 9:37 PM
 */

namespace Core\User;


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
	}

	/**
	 * TODO: Test method
	 */
	public function testQuery() {
		$userMapper = $this;
		$genderMapper = new \Core\User\GenderMapper();

		$query = "
			SELECT
				{$userMapper->select('u')},
				{$genderMapper->select('g')}
			FROM `user` AS u
			LEFT JOIN gender g ON u.gender_id = g.id
		";

		$statement = $this->getDatabase()->prepare($query);
		$statement->execute();

		foreach($statement as $row) {
			$user = $userMapper->hydrate('u', $row);
			$gender = $genderMapper->hydrate('g', $row);

			$user->setGender($gender);
			new \App\Probe($user);
		}
	}
} 