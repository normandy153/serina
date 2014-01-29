<?php
/**
 * User.php
 *
 * Date: 28/01/2014
 * Time: 11:25 PM
 */

namespace Core;


class User {

	/**
	 * User id
	 *
	 * @var int
	 */
	private $id = -1;

	/**
	 * User's first name
	 *
	 * @var string
	 */
	private $firstname = '';

	/**
	 * User's last name
	 *
	 * @var string
	 */
	private $lastname = '';

	/**
	 * User's birthdate in reverse order (y-m-d)
	 *
	 * @var string
	 */
	private $birthdate = '';

	/**
	 * An instance of User\Gender
	 *
	 * @var null
	 */
	private $gender = null;

	/**
	 * An instance of User\Address
	 *
	 * @var null
	 */
	private $address = null;

	/**
	 * An instance of User\Phone
	 *
	 * @var null
	 */
	private $phone = null;

	/**
	 * User's email address
	 *
	 * @var string
	 */
	private $email = '';

	/**
	 * The date when the user account was requested to be updated
	 *
	 * @var string
	 */
	private $applicationDate = '';

	/**
	 * A collection of emergency contacts
	 *
	 * @var null
	 */
	private $emergencyContact = null;

	/**
	 * Image file id
	 *
	 * @var int
	 */
	private $avatarId = -1;

	/**
	 * An instance of User\Account
	 *
	 * @var null
	 */
	private $account = null;

	/**
	 * The date when the user record was first created
	 *
	 * @var string
	 */
	private $createdAt = '';

	/**
	 * The date when the user record was last updated
	 *
	 * @var string
	 */
	private $updatedAt = '';

	/**
	 * The date when the user record was deleted
	 *
	 * @var string
	 */
	private $deletedAt = '';
} 