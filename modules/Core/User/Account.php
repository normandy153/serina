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
	 * Id
	 *
	 * @var null
	 */
	private $id = null;

	/**
	 * The user to whom this accont belongs
	 *
	 * @var null
	 */
	private $userId = null;

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
	 * An instance of Avatar
	 *
	 * @var Avatar
	 */
	private $avatar = null;

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
	 * Whether or not this account is enabled
	 * $lock = 0 enables it; $lock = 1 disables it
	 *
	 * @var int
	 */
	private $locked = 0;

	/**
	 * Created timestamp
	 *
	 * @var string
	 */
	private $createdAt = '';

	/**
	 * Updated timestamp
	 *
	 * @var string
	 */
	private $updatedAt = '';

	/**
	 * Deleted timestamp
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

	/**
	 * Set avatar
	 *
	 * @param \Core\User\Avatar $avatar
	 */
	public function setAvatar($avatar) {
		$this->avatar = $avatar;
	}

	/**
	 * Get avatar
	 *
	 * @return \Core\User\Avatar
	 */
	public function getAvatar() {
		return $this->avatar;
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

	/**
	 * Set locked
	 *
	 * @param int $locked
	 */
	public function setLocked($locked) {
		$this->locked = $locked;
	}

	/**
	 * Get locked
	 *
	 * @return int
	 */
	public function getLocked() {
		return $this->locked;
	}
} 