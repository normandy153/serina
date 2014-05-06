<?php
/**
 * PropertyDefinition.php
 *
 * Date: 6/04/2014
 * Time: 1:49 PM
 */

namespace App\Mapper;


class PropertyDefinition {

	/**
	 * A model property
	 *
	 * @var string
	 */
	private $property = '';

	/**
	 * A database column
	 *
	 * @var string
	 */
	private $column = '';

	/**
	 * Data type for this column, for PDO
	 *
	 * @var string
	 */
	private $type = '';

	/**
	 * Constructor
	 *
	 * @param $property
	 * @param $column
	 * @param $type
	 */
	public function __construct($property, $column, $type) {
		$this->setProperty($property);
		$this->setColumn($column);
		$this->setType($type);
	}

	/**
	 * Figure out which model setter to use
	 *
	 * @return string
	 */
	public function deriveMethod() {
		return 'set' . ucwords($this->getProperty());
	}

	/* Getters/Setters
	 */

	/**
	 * Set column
	 *
	 * @param string $column
	 */
	private function setColumn($column) {
		$this->column = $column;
	}

	/**
	 * Get column
	 *
	 * @return string
	 */
	public function getColumn() {
		return $this->column;
	}

	/**
	 * Set property
	 *
	 * @param string $property
	 */
	private function setProperty($property) {
		$this->property = $property;
	}

	/**
	 * Get property
	 *
	 * @return string
	 */
	public function getProperty() {
		return $this->property;
	}

	/**
	 * Set type
	 *
	 * @param string $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Get type
	 *
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}
} 