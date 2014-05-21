<?php
/**
 * Address.php
 *
 * Date: 29/01/2014
 * Time: 11:23 PM
 */

namespace Core\User;


class Address {

	/**
	 * Id
	 *
	 * @var int
	 */
	private $id = null;

	/**
	 * Address 1
	 *
	 * @var string
	 */
	private $address1 = '';

	/**
	 * Address 2
	 *
	 * @var string
	 */
	private $address2 = '';

	/**
	 * Suburb
	 *
	 * @var string
	 */
	private $suburb = '';

	/**
	 * An instance of User\State
	 *
	 * @var string
	 */
	private $state = null;

	/**
	 * Postcode
	 *
	 * @var string
	 */
	private $postcode = '';

	/**
	 * An instance of User\Country
	 *
	 * @var string
	 */
	private $country = null;

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

	/* Getters/Setters
	 */

	/**
	 * Set address 1
	 *
	 * @param string $address1
	 */
	public function setAddress1($address1) {
		$this->address1 = $address1;
	}

	/**
	 * Get address 1
	 *
	 * @return string
	 */
	public function getAddress1() {
		return $this->address1;
	}

	/**
	 * Set address 2
	 *
	 * @param string $address2
	 */
	public function setAddress2($address2) {
		$this->address2 = $address2;
	}

	/**
	 * Get address 2
	 *
	 * @return string
	 */
	public function getAddress2() {
		return $this->address2;
	}

	/**
	 * Set country
	 *
	 * @param string $country
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Get country
	 *
	 * @return string
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Set postcode
	 *
	 * @param string $postcode
	 */
	public function setPostcode($postcode) {
		$this->postcode = $postcode;
	}

	/**
	 * Get postcode
	 *
	 * @return string
	 */
	public function getPostcode() {
		return $this->postcode;
	}

	/**
	 * Set state
	 *
	 * @param string $state
	 */
	public function setState($state) {
		$this->state = $state;
	}

	/**
	 * Get state
	 *
	 * @return string
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * Set suburb
	 *
	 * @param string $suburb
	 */
	public function setSuburb($suburb) {
		$this->suburb = $suburb;
	}

	/**
	 * @return string
	 */
	public function getSuburb() {
		return $this->suburb;
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