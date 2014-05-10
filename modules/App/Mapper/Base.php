<?php
/**
 * Base.php
 *
 * Date: 13/03/2014
 * Time: 10:14 PM
 */

namespace App\Mapper;

abstract class Base {

	/** Column data types
	 */
	const TYPE_STR = \PDO::PARAM_STR;
	const TYPE_INT = \PDO::PARAM_INT;
	const TYPE_COLLECTION = -1;

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
		$this->setProperties(new \App\Collection());

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
	 * @param $type
	 */
	protected function addProperty($property, $column, $type) {
		$this->getProperties()->add(new PropertyDefinition($property, $column, $type));
	}

	/**
	 * Macro for adding timestamp-based properties
	 */
	protected function addTimestampable() {
		$this->addProperty('createdAt', 'created_at', self::TYPE_STR);
		$this->addProperty('updatedAt', 'updated_at', self::TYPE_STR);
		$this->addProperty('deletedAt', 'deleted_at', self::TYPE_STR);
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
				$property1 = $useRule['this']['property'];

				/* Find stuff from $collection2 using this key
				 */
				$property2 = $useRule['other']['property'];

				/* Stuff from $collection2 gets dumped into $key1
 				 */
				$property3 = $useRule['this']['collection'];

				/* Set the resultant collection of $collection2 items
				 * into items from $collection1
				 */
				$setter = $query->deriveSetterMethodFromProperty($property3, $useRule['this']['mapper']);

				/* Used to compare keys for matching items
				 */
				$getter1 = $query->deriveGetterMethodFromProperty($property1, $useRule['this']['mapper']);
				$getter2 = $query->deriveGetterMethodFromProperty($property2, $useRule['other']['mapper']);

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

	/**
	 * Save an object to the db
	 *
	 * @param $object
	 */
	public function save($object) {
		$columns = array();
		$placeholders = array();
		$updates = array();

		foreach($this->getProperties() as $currentProperty) {
			$method = $this->deriveGetterMethod($currentProperty->getColumn());

			$columns[] = $currentProperty->getColumn();
			$placeholders[] = ':' . $currentProperty->getColumn();
			$updates[] = "{$currentProperty->getColumn()} = :{$currentProperty->getColumn()}";

			$params[$currentProperty->getColumn()] = array(
				'column' => $object->$method(),
				'type' => $currentProperty->getType(),
			);
		}

		$allColumns = '(`' . implode("`, `", $columns) . '`)';
		$allPlaceholders = '(' . implode(', ', $placeholders) . ')';
		$allUpdates = implode(', ', $updates);

		$querystring = "
			INSERT INTO `{$this->getTable()}` {$allColumns}
			VALUES {$allPlaceholders}
			ON DUPLICATE KEY UPDATE {$allUpdates}
		";

		try {
			$query = new \App\Mapper\Query();
			$query->prepareRawQuery($querystring);
			$query->execute($params);

			$lastInsertId = $query->getLastInsertId();

			/* If it updated an existing record, getLastInsertId() will return null
			 * This allows you to prevent overwriting the primary key of an object
			 * accidentally, filling it with 0 which is what PDO normally returns
			 */
			if ($lastInsertId !== null) {
				$object->setId($lastInsertId);
			}
		}
		catch (\PDOException $e) {
			new \App\Probe($e->getMessage());
		}
	}

	/**
	 * Find a method name from a property
	 *
	 * @param $column
	 * @throws \Exception
	 * @return mixed
	 */
	public function deriveGetterMethod($column) {
		$stack = array('get');

		$bits = explode('_', $column);

		foreach($bits as $current) {
			$stack[] = ucwords($current);
		}

		return implode('', $stack);
	}

	/* Shared Retrieval Methods
	 *
	 * A bunch of commonly-used methods here for extracting data
	 * from the db. Uses the Query class to hydrate for you
	 */

	/**
	 * Find an object by its primary key
	 *
	 * @param $id
	 * @return null
	 */
	public function findById($id) {
		$query = new \App\Mapper\Query();

		$statement = $query
			->select("{$this->getModel()} m")
			->from('m')
			->where('id = :id')
			->prepare()
			->execute(array(
				'id' => array(
					'column' => $id,
					'type' => \PDO::PARAM_INT
				)
			));

		$row = $statement->fetch();

		$object = $this->hydrate('m', $row);

		return $object;
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