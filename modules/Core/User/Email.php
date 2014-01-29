<?php
/**
 * Email.php
 *
 * Date: 30/01/2014
 * Time: 12:07 AM
 */

namespace Core\User;


class Email {

	/**
	 * Email address
	 *
	 * @var string
	 */
	private $address = '';

	/**
	 * Constructor
	 */
	public function __construct($address) {
		$this->setAddress($address);
	}

	/**
	 * Determine whether the provided email address is valid
	 *
	 * @return bool
	 */
	public function isValid() {
		return true;
	}

	/* Getters/Setters
	 */

	/**
	 * @param string $address
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * @return string
	 */
	public function getAddress() {
		return $this->address;
	}
} 