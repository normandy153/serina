<?php
/**
 * Account.php
 *
 * Date: 4/02/2014
 * Time: 11:26 PM
 */

namespace Core\User;


class Account {

	/**
	 * Username
	 *
	 * @var string
	 */
	private $username = '';

	/**
	 * Hashed password
	 *
	 * @var string
	 */
	private $password = '';

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/* Getters/Setters
	 */

	/**
	 * Set password
	 *
	 * @param string $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * Get password
	 *
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * Set username
	 *
	 * @param string $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * Get username
	 *
	 * @return string
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * One-way hash
	 *
	 * @param $value
	 * @return string
	 */
	public function encode($value) {
		return sha1($value);
	}
} 