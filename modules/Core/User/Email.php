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
	 * Id
	 *
	 * @var null
	 */
	private $id = null;

	/**
	 * The user this email belongs to
	 *
	 * @var null
	 */
	private $userId = null;

	/**
	 * Email address
	 *
	 * @var string
	 */
	private $address = '';

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
	 * Set address
	 *
	 * @param string $address
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * Get address
	 *
	 * @return string
	 */
	public function getAddress() {
		return $this->address;
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
} 