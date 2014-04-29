<?php
/**
 * Contact.php
 *
 * Date: 29/04/2014
 * Time: 11:19 PM
 */

namespace Core\User;


class Contact {

	/**
	 * Id
	 *
	 * @var null
	 */
	private $id = null;

	/**
	 * The user to whom this contact belongs
	 *
	 * @var null
	 */
	private $userId = null;

	/**
	 * Firstname
	 *
	 * @var string
	 */
	private $firstname = '';

	/**
	 * Lastname
	 *
	 * @var string
	 */
	private $lastname = '';

	/**
	 * Phone
	 *
	 * @var string
	 */
	private $phone = '';

	/**
	 * Additional notes
	 *
	 * @var string
	 */
	private $notes = '';

	/**
	 * The date when the record was first created
	 *
	 * @var string
	 */
	private $createdAt = '';

	/**
	 * The date when the record was last updated
	 *
	 * @var string
	 */
	private $updatedAt = '';

	/**
	 * The date when the record was deleted
	 *
	 * @var string
	 */
	private $deletedAt = '';

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/* Getters/Setters
	 */

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
	 * Set id
	 *
	 * @param null $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * Get id
	 *
	 * @return null
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
	 * Set notes
	 *
	 * @param string $notes
	 */
	public function setNotes($notes) {
		$this->notes = $notes;
	}

	/**
	 * Get notes
	 *
	 * @return string
	 */
	public function getNotes() {
		return $this->notes;
	}

	/**
	 * Set phone
	 *
	 * @param string $phone
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * Get phone
	 *
	 * @return string
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Set user id
	 *
	 * @param null $userId
	 */
	public function setUserId($userId) {
		$this->userId = $userId;
	}

	/**
	 * Get user id
	 *
	 * @return null
	 */
	public function getUserId() {
		return $this->userId;
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
} 