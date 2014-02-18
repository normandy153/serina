<?php
/**
 * Avatar.php
 *
 * Date: 18/02/2014
 * Time: 11:03 PM
 */

namespace Core\User;


class Avatar {

	/**
	 *
	 * @var string
	 */
	private $filepath = '';

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/* Getters/Setters
	 */

	/**
	 * Set filepath
	 *
	 * @param string $filepath
	 */
	public function setFilepath($filepath) {
		$this->filepath = $filepath;
	}

	/**
	 * Get filepath
	 *
	 * @return string
	 */
	public function getFilepath() {
		return $this->filepath;
	}
} 