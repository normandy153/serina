<?php
/**
 * UserFactory.php
 *
 * Date: 7/02/2014
 * Time: 12:44 AM
 */

namespace Core\User\Generator;


class UserFactory extends Base {

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/**
	 * Spawn item
	 *
	 * @return mixed
	 */
	public function spawn() {
		$personFactory = new PersonFactory();

		$contact = $personFactory->spawn();
		$user = $personFactory->spawn();
		$user->setEmergencyContact($contact);

		return $user;
	}
} 