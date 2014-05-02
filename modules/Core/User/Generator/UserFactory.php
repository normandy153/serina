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

		$allContacts = new \App\Collection();
		$allContacts->add($personFactory->spawn());
		$allContacts->add($personFactory->spawn());
		$allContacts->add($personFactory->spawn());

		$user = $personFactory->spawn();
		$user->setContact($allContacts);

		return $user;
	}
} 