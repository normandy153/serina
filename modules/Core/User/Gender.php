<?php
/**
 * Gender.php
 *
 * Date: 29/01/2014
 * Time: 11:13 PM
 */

namespace Core\User;


class Gender {

	/**
	 * Id
	 *
	 * @var int
	 */
	private $id = -1;

	/**
	 * Single-letter representation
	 *
	 * @var string
	 */
	private $abbreviation = '';

	/**
	 * Gender name (descriptive)
	 *
	 * @var string
	 */
	private $name = '';

	/**
	 * From a string, set values
	 *
	 * @param $string
	 */
	public function construct($string) {
		switch(strtolower($string)) {
			case 'm':
			case 'male':
				$this->setAbbreviation('M')->setName('Male');
				break;

			case 'f':
			case 'female':
				$this->setAbbreviation('F')->setName('Female');
				break;

			default:
				break;
		}
	}

	/* Getters/Setters
	 */

	/**
	 * Set abbreviation
	 *
	 * @param string $abbreviation
	 * @return $this
	 */
	private function setAbbreviation($abbreviation) {
		$this->abbreviation = $abbreviation;

		return $this;
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
	 * Set name
	 *
	 * @param string $name
	 * @return $this
	 */
	private function setName($name) {
		$this->name = $name;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
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
} 