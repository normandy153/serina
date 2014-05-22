<?php
/**
 * PhoneType.php
 *
 * Date: 29/01/2014
 * Time: 11:54 PM
 */

namespace Core\User;


class PhoneType {

	/**
	 * Id
	 *
	 * @var int
	 */
	private $id = null;

	/**
	 * The name of the phone type
	 *
	 * @var null
	 */
	private $name = '';

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
	 * Set name
	 *
	 * @param null $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get name
	 *
	 * @return null
	 */
	public function getName() {
		return $this->name;
	}
} 