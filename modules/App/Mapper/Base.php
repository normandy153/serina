<?php
/**
 * Base.php
 *
 * Date: 13/03/2014
 * Time: 10:14 PM
 */

namespace App\Mapper;

abstract class Base {

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
	 * A list of joins
	 *
	 * @var array
	 */
	protected $joins = array();

	/**
	 * Constructor
	 */
	final public function __construct() {
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

		$hydrator = new Hydrator(new $model(), $this->getProperties(), $alias, $row);

		return $hydrator->getProduct();
	}

	/**
	 * Add a join rule
	 *
	 * @param $name
	 * @param $item
	 */
	public function addJoin($name, $item) {
		$this->joins[$name] = $item;
	}

	/**
	 * Get a join rule by its name
	 * 
	 * @param $name
	 * @return mixed
	 */
	public function getJoin($name) {
		return $this->joins[$name];
	}

	/**
	 * Join two collections using the rule $rule used in $query
	 *
	 * $collection2 items get joined into $collection1 items
	 *
	 * @param \App\Collection $collection1
	 * @param \App\Collection $collection2
	 * @param $rule
	 * @param Query $query
	 * @throws \Exception
	 */
	protected function joinCollections(\App\Collection $collection1, \App\Collection $collection2, $rule, Query $query) {
		$rules = $query->getRules();

		$useRule = false;
		$getter1 = false;
		$getter2 = false;

		foreach($rules as $currentRule) {
			if ($currentRule['name'] == $rule) {
				$useRule = $currentRule['rule'];

				/* Find stuff in $collection1 using this key
				 */
				$key1 = $useRule['this']['key'];

				/* Find stuff from $collection2 using this key
				 */
				$key2 = $useRule['other']['key'];

				/* Stuff from $collection2 gets dumped into $key1
 				 */
				$key3 = $useRule['this']['collection'];

				/* Set the resultant collection of $collection2 items
				 * into items from $collection1
				 */
				$setter = $query->deriveSetterMethodFromColumn($key3, $useRule['this']['mapper']);

				/* Used to compare keys for matching items
				 */
				$getter1 = $query->deriveGetterMethodFromColumn($key1, $useRule['this']['mapper']);
				$getter2 = $query->deriveGetterMethodFromColumn($key2, $useRule['other']['mapper']);

				break;
			}
		}

		/* Proceed if all bits are found
		 */
		if ($useRule && $getter1 && $getter2) {
			$allKeys = array_keys($collection1->getStack());

			foreach($allKeys as $currentKey) {
				$final = new \App\Collection();

				$rootNode = $collection1->getItemAt($currentKey);
				$collection2->reindex();

				foreach($collection2 as $current) {
					if ($rootNode->$getter1() == $current->$getter2()) {
						$final->add($current);
					}
				}

				$rootNode->$setter($final);
			}
		}
		else {
			throw new \Exception('Join rule not found.');
		}
	}

	/* Getters/Setters
	 */

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
	public function getModel() {
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