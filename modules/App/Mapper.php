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
	 * Populate the specified object from columns with $alias prefix
	 *
	 * @param $alias
	 * @param $row
	 * @return
	 */
	protected function hydrate($alias, $row) {
		$model = $this->getModel();

		$hydrator = new Mapper\Hydrator(new $model(), $this->getProperties(), $alias, $row);

		return $hydrator->getProduct();
	}


	public function addJoin($name, $item) {
		$this->joins[$name] = $item;
	}

	// User u
	public function from($thisModel, $alias) {
		return "FROM `{$this->getTable()}` {$alias}";
	}

	// User Phone
	public function join($otherModel, $otherAlias) {
		$otherTable = $this->joins[$otherModel]['other']['table'];
		$otherAlias = $otherAlias;
		$otherKey = $this->joins[$otherModel]['other']['key'];
		$thisTable = $this->getTable();
		$thisAlias = $this->joins[$otherModel]['this']['alias'];
		$thisKey = $this->joins[$otherModel]['this']['key'];

		$str = "
			LEFT JOIN {$otherTable} {$otherAlias}
			ON {$otherAlias}.{$otherKey} = {$thisAlias}.{$thisKey}
		";

		return $str;
	}

	public function build(\App\Collection $rowCollection) {

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
	 * Made public so it can be used to dynamically hydrate and
	 * map objects in the Query
	 *
	 * @return array
	 */
	public function getProperties() {
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
	 * Made public so it can be used to dynamically hydrate and
	 * map objects in the Query
	 *
	 * @return string
	 */
	public function getTable() {
		return $this->table;
	}
} 