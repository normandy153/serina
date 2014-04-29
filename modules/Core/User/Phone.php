<?php
/**
 * Phone.php
 *
 * Date: 29/01/2014
 * Time: 11:54 PM
 */

namespace Core\User;


class Phone {

	/**
	 * Id
	 *
	 * @var int
	 */
	private $id = null;

	/**
	 * The user who owns this phone
	 *
	 * @var null
	 */
	private $userId = null;

	/**
	 * The type of number this is
	 *
	 * @var null
	 */
	private $typeId = null;

	/**
	 * Phone number
	 *
	 * @var string
	 */
	private $number = '';

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
	 * Set number
	 *
	 * @param string $number
	 */
	public function setNumber($number) {
		$this->number = $number;
	}

	/**
	 * Get number
	 *
	 * @return string
	 */
	public function getNumber() {
		return $this->number;
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
	 * Set type id
	 *
	 * @param null $typeId
	 */
	public function setTypeId($typeId) {
		$this->typeId = $typeId;
	}

	/**
	 * Get type id
	 *
	 * @return null
	 */
	public function getTypeId() {
		return $this->typeId;
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