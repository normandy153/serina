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
	private $id = -1;

	/**
	 * Phone number
	 *
	 * @var string
	 */
	private $number = '';

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
} 