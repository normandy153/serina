<?php
/**
 * AccountFactory.php
 *
 * Date: 7/02/2014
 * Time: 12:00 AM
 */

namespace Core\User\Generator;


class AccountFactory {

	/**
	 * Firstname
	 *
	 * @var string
	 */
	private $firstname = '';

	/**
	 * Surname
	 *
	 * @var string
	 */
	private $surname = '';

	/**
	 * Constructor
	 *
	 * @param $firstname
	 * @param $surname
	 */
	public function __construct($firstname, $surname) {
		$this->setFirstname($firstname);
		$this->setSurname($surname);
	}

	/**
	 * Spawn an account
	 *
	 * @return \Core\User\Account
	 */
	public function spawn() {
		$username = strtolower($this->getSurname() . $this->getFirstname() . rand(100, 999));
		$password = sha1($username);

		$activationDate = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
		$expiryDate = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME'] + 60*60*24*365);

		$avatarFactory = new AvatarFactory();
		$avatar = $avatarFactory->spawn();

		$account = new \Core\User\Account();
		$account->setUsername($username);
		$account->setPassword($password);
		$account->setActivationDate($activationDate);
		$account->setExpiryDate($expiryDate);
		$account->setAvatar($avatar);

		return $account;
	}

	/* Getters/Setters
	 */

	/**
	 * Set firstname
	 *
	 * @param string $firstname
	 */
	private function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	/**
	 * Get firstname
	 *
	 * @return string
	 */
	private function getFirstname() {
		return $this->firstname;
	}

	/**
	 * Set surname
	 *
	 * @param string $surname
	 */
	private function setSurname($surname) {
		$this->surname = $surname;
	}

	/**
	 * Get surname
	 *
	 * @return string
	 */
	private function getSurname() {
		return $this->surname;
	}
} 