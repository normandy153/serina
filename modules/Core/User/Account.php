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
	 * The date when the account was activated
	 *
	 * @var string
	 */
	private $activationDate = '';

	/**
	 * The date when the account will be deactivated
	 *
	 * @var string
	 */
	private $expiryDate = '';

	/**
	 * Constructor
	 */
	public function __construct() {

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
	 * Set activation date
	 *
	 * @param string $activationDate
	 */
	public function setActivationDate($activationDate) {
		$this->activationDate = $activationDate;
	}

	/**
	 * Get activation date
	 *
	 * @return string
	 */
	public function getActivationDate() {
		return $this->activationDate;
	}

	/**
	 * Set expiry date
	 *
	 * @param string $expiryDate
	 */
	public function setExpiryDate($expiryDate) {
		$this->expiryDate = $expiryDate;
	}

	/**
	 * Get expiry date
	 *
	 * @return string
	 */
	public function getExpiryDate() {
		return $this->expiryDate;
	}
} 