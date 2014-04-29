<?php
/**
 * Vehicle.php
 *
 * Date: 29/04/2014
 * Time: 10:17 PM
 */

namespace Core\User;


class Vehicle {

	/**
	 * Id
	 *
	 * @var null
	 */
	private $id = null;

	/**
	 * The user this car belongs to
	 *
	 * @var null
	 */
	private $userId = null;

	/**
	 * Registration number of the car
	 *
	 * @var string
	 */
	private $registration = '';

	/**
	 * The maximum number of passengers this vehicle
	 * can transport. For a typical sedan, this value
	 * should be 5. For overnight trips, it can be
	 * assumed as 4. It is however up to the user to
	 * specify the capacity of their transport
	 *
	 * @var string
	 */
	private $passengers = '';

	/**
	 * A short and sweet description of the vehicle
	 * (colour, make, noteworthy identifying characteristics)
	 *
	 * @var string
	 */
	private $description = '';

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
	 * Set passengers
	 *
	 * @param string $passengers
	 */
	public function setPassengers($passengers) {
		$this->passengers = $passengers;
	}

	/**
	 * Get passengers
	 *
	 * @return string
	 */
	public function getPassengers() {
		return $this->passengers;
	}

	/**
	 * Set registration
	 *
	 * @param string $registration
	 */
	public function setRegistration($registration) {
		$this->registration = $registration;
	}

	/**
	 * Get registration
	 *
	 * @return string
	 */
	public function getRegistration() {
		return $this->registration;
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
	 * Set description
	 *
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
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