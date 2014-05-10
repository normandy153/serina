<?php
/**
 * User.php
 *
 * Date: 28/01/2014
 * Time: 11:25 PM
 */

namespace Core\User;


class User {

	/**
	 * User id
	 *
	 * @var int
	 */
	private $id = null;

	/**
	 * Non-incrementing unique identifier
	 *
	 * @var string
	 */
	private $uuid = '';

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
	 * An instance of User\Email
	 *
	 * @var string
	 */
	private $email = '';

	/**
	 * An instance of Collection
	 *
	 * @var null
	 */
	private $vehicle = null;

	/**
	 * A collection of emergency contacts
	 *
	 * @var null
	 */
	private $contact = null;

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

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/**
	 * Set account
	 *
	 * @param null $account
	 */
	public function setAccount($account) {
		$this->account = $account;
	}

	/**
	 * Get account
	 *
	 * @return null
	 */
	public function getAccount() {
		return $this->account;
	}

	/**
	 * Set address
	 *
	 * @param null $address
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * Get address
	 *
	 * @return null
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Set avatar id
	 *
	 * @param int $avatarId
	 */
	public function setAvatarId($avatarId) {
		$this->avatarId = $avatarId;
	}

	/**
	 * Get avatar id
	 *
	 * @return int
	 */
	public function getAvatarId() {
		return $this->avatarId;
	}

	/**
	 * Set birthdate
	 *
	 * @param string $birthdate
	 */
	public function setBirthdate($birthdate) {
		$this->birthdate = $birthdate;
	}

	/**
	 * Get birthdate
	 *
	 * @return string
	 */
	public function getBirthdate() {
		return $this->birthdate;
	}

	/**
	 * Set created at
	 *
	 * @param string $createdAt
	 */
	public function setCreatedAt($createdAt) {
		$this->createdAt = $createdAt;
	}

	/**
	 * Get created at
	 *
	 * @return string
	 */
	public function getCreatedAt() {
		return $this->createdAt;
	}

	/**
	 * Set deleted at
	 *
	 * @param string $deletedAt
	 */
	public function setDeletedAt($deletedAt) {
		$this->deletedAt = $deletedAt;
	}

	/**
	 * Get deleted at
	 *
	 * @return string
	 */
	public function getDeletedAt() {
		return $this->deletedAt;
	}

	/**
	 * Set email
	 *
	 * @param string $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Set contact
	 *
	 * @param null $contact
	 */
	public function setContact($contact) {
		$this->contact = $contact;
	}

	/**
	 * Get contact
	 *
	 * @return null
	 */
	public function getContact() {
		return $this->contact;
	}

	/**
	 * Set firstname
	 *
	 * @param string $firstname
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	/**
	 * Get firstname
	 *
	 * @return string
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * Set gender
	 *
	 * @param null $gender
	 */
	public function setGender($gender) {
		$this->gender = $gender;
	}

	/**
	 * Get gender
	 *
	 * @return null
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * Set id
	 *
	 * @param int $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set lastname
	 *
	 * @param string $lastname
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	/**
	 * Get lastname
	 *
	 * @return string
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * Set phone
	 *
	 * @param null $phone
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * Get phone
	 *
	 * @return null
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Set updated at
	 *
	 * @param string $updatedAt
	 */
	public function setUpdatedAt($updatedAt) {
		$this->updatedAt = $updatedAt;
	}

	/**
	 * Get updated at
	 *
	 * @return string
	 */
	public function getUpdatedAt() {
		return $this->updatedAt;
	}

	/**
	 * Set uuid
	 *
	 * @param string $uuid
	 */
	public function setUuid($uuid) {
		$this->uuid = $uuid;
	}

	/**
	 * Get uuid
	 *
	 * @return string
	 */
	public function getUuid() {
		return $this->uuid;
	}

	/**
	 * Set vehicle
	 *
	 * @param null $vehicle
	 */
	public function setVehicle($vehicle) {
		$this->vehicle = $vehicle;
	}

	/**
	 * Get vehicle
	 *
	 * @return null
	 */
	public function getVehicle() {
		return $this->vehicle;
	}

} 