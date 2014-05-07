<?php
/**
 * State.php
 *
 * Date: 29/01/2014
 * Time: 11:42 PM
 */

namespace Core\User;


class State {

	/**
	 * Id
	 *
	 * @var int
	 */
	private $id = null;

	/**
	 * Abbreviation
	 *
	 * @var string
	 */
	private $abbreviation = '';

	/**
	 * Name
	 *
	 * @var string
	 */
	private $name = '';

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/**
	 * Set abbreviation
	 *
	 * @param string $abbreviation
	 */
	public function setAbbreviation($abbreviation) {
		$this->abbreviation = $abbreviation;
	}

	/**
	 * Get abbreviation
	 *
	 * @return string
	 */
	public function getAbbreviation() {
		return $this->abbreviation;
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
	 * Set name
	 *
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
} 