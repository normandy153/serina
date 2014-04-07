<?php
/**
 * Mapper.php
 *
 * Date: 13/03/2014
 * Time: 10:14 PM
 */

namespace App;

use \App\Mapper\PropertyDefinition as PropertyDefinition;

abstract class Mapper {

	/**
	 * An instance of Database
	 *
	 * @var Database
	 */
	private $database = null;

	/**
	 * The model used by this mapper for automatic hydration
	 *
	 * @var string
	 */
	protected $model = '';

	/**
	 * The database table used by this mapper for automatic hydration
	 *
	 * @var string
	 */
	protected $table = '';

	/**
	 * A list of class var/db column pairs
	 *
	 * @var array
	 */
	protected $properties = array();

	/**
	 * Constructor
	 */
	final public function __construct() {
		$this->setDatabase(new Database());
		$this->properties();
		$this->setup();
	}

	/**
	 * Define properties
	 *
	 * @return mixed
	 */
	abstract protected function properties();

	/**
	 * Setup hook method
	 */
	protected function setup() {

	}

	/**
	 * Add a property definition
	 *
	 * @param $property
	 * @param $column
	 */
	protected function addProperty($property, $column) {
		$this->properties[] = new PropertyDefinition($property, $column);
	}

	/**
	 * Populate the specified object
	 *
	 * @param $row
	 */
	protected function hydrate($row) {
		$model = $this->getModel();
		$instance = new $model();

		foreach($this->getProperties() as $currentDefinition) {
			$method = $currentDefinition->deriveMethod();
			$column = $currentDefinition->getColumn();

			$instance->$method($row[$column]);
		}

		return $instance;
	}

	/**
	 * Exact select macro, used mostly when joining tables where the
	 * column names might clash. This deconflicts shared names like
	 * id, name, created_at, etc.
	 *
	 * Pass it a table alias to use it as a prefix
	 *
	 * @param $alias
	 * @return string
	 */
	public function select($alias) {
		$string = array();
		$template = "{COLUMN} AS {ALIAS}__{COLUMN}";

		$pattern = array(
			'{COLUMN}',
			'{ALIAS}'
		);

		foreach ($this->getProperties() as $currentProperty) {
			$replace = array(
				$currentProperty->getColumn(),
				$alias
			);

			$string[] = str_replace($pattern, $replace, $template);
		}

		$str = implode(', ', $string);

		return $str;
	}

	/* Getters/Setters
	 */

	/**
	 * Set database
	 *
	 * @param \App\Database $database
	 */
	protected function setDatabase($database) {
		$this->database = $database;
	}

	/**
	 * Get database
	 *
	 * @return \App\Database
	 */
	protected function getDatabase() {
		return $this->database;
	}

	/**
	 * Set model
	 *
	 * @param string $model
	 */
	protected function setModel($model) {
		$this->model = $model;
	}

	/**
	 * Get model
	 *
	 * @return string
	 */
	protected function getModel() {
		return $this->model;
	}

	/**
	 * Set properties
	 *
	 * @param array $properties
	 */
	protected function setProperties($properties) {
		$this->properties = $properties;
	}

	/**
	 * Get properties
	 *
	 * @return array
	 */
	protected function getProperties() {
		return $this->properties;
	}

	/**
	 * Set table
	 *
	 * @param string $table
	 */
	protected function setTable($table) {
		$this->table = $table;
	}

	/**
	 * Get table
	 *
	 * @return string
	 */
	public function getTable() {
		return $this->table;
	}
} 