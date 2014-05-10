<?php
/**
 * Query.php
 *
 * Date: 25/04/2014
 * Time: 2:04 PM
 */

namespace App\Mapper;


class Query {

	/**
	 * An instance of Database
	 *
	 * @var Database
	 */
	private $database = null;

	/**
	 * The resultant query string to be executed
	 *
	 * @var string
	 */
	private $queryString = array();

	/**
	 * A QueryRegistry instance
	 *
	 * @var QueryRegistry
	 */
	private $queryRegistry = null;

	/**
	 * An object graph represented by an array of alias relations
	 *
	 * @var array
	 */
	private $objectGraph = array();

	/**
	 * A list of join rules used in this query
	 *
	 * @var array
	 */
	private $rules = array();

	/**
	 * The final query string ready to be passed to database layer
	 *
	 * @var string
	 */
	private $query = '';

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->setDatabase(new \App\Database());
		$this->setQueryRegistry(new QueryRegistry());
	}

	/**
	 * Exact select macro, used mostly when joining tables where the
	 * column names might clash. This deconflicts shared names like
	 * id, name, created_at, etc.
	 *
	 * Pass it a table alias to use it as a prefix
	 *
	 * @return $this
	 */
	public function select() {
		$string = array();
		$template = "{ALIAS}.{COLUMN} AS {ALIAS}__{COLUMN}";

		/* Replacement strings
		 */
		$pattern = array(
			'{COLUMN}',
			'{ALIAS}'
		);

		/* Find out the select string for each of the models specified
		 */
		foreach(func_get_args() as $currentSelect) {
			list($model, $alias) = explode(' ', $currentSelect);

			/* Spawn a mapper to get to the model property definitions
			 */
			$mapper = $this->getQueryRegistry()->getMapper($this->getMapperNameFromModel($model), $alias);

			foreach ($mapper->getProperties() as $currentProperty) {
				if (!$currentProperty->isCollection()) {
					$replace = array(
						$currentProperty->getColumn(),
						$alias
					);

					$string[] = str_replace($pattern, $replace, $template);
				}
			}

			/* Remember instances of everything we found in the select
			 */
			$this->getQueryRegistry()->addModel($alias, $model);
			$this->getQueryRegistry()->addMapper($alias, $mapper);
		}

		$str = implode(', ', $string);

		/* Augment query string
		 */
		$this->augmentQueryString('SELECT');
		$this->augmentQueryString($str);

		return $this;
	}

	/**
	 * From
	 */
	public function from($alias) {
		$registry = $this->getQueryRegistry()->getRegistry();

		/* Spawn a mapper to get to the model property definitions
		 * and to find the table name. Add to registry if it doesn't
		 * already exist there
		 */
		$mapper = $this->getQueryRegistry()->getMapper($registry[$alias]['mapper'], $alias);

		/* Augment query string
		 */
		$this->augmentQueryString('FROM');
		$this->augmentQueryString("`{$mapper->getTable()}` {$alias}");

		return $this;
	}

	/**
	 * Alias to join()
	 *
	 * @param $thisAlias
	 * @param $joinRule
	 * @param $otherAlias
	 * @return $this
	 */
	public function leftJoin($thisAlias, $joinRule, $otherAlias) {
		return $this->join('left', $thisAlias, $joinRule, $otherAlias);
	}

	/**
	 * Alias to join()
	 *
	 * @param $thisAlias
	 * @param $joinRule
	 * @param $otherAlias
	 * @return $this
	 */
	public function innerJoin($thisAlias, $joinRule, $otherAlias) {
		return $this->join('inner', $thisAlias, $joinRule, $otherAlias);
	}

	/**
	 * Join
	 *
	 * Joins the left model onto another specified in left model's $joinRule
	 * This is left centric; the $thisAlias mapper contains the relationship rule
	 *
	 * @param $type
	 * @param $thisAlias
	 * @param $joinRule
	 * @param $otherAlias
	 * @throws \Exception
	 * @return $this
	 */
	private function join($type, $thisAlias, $joinRule, $otherAlias) {
		$registry = $this->getQueryRegistry()->getRegistry();

		/* Spawn a mapper to get to the model property definitions
		 * and to find the table name
		 */
		$rule = $registry[$thisAlias]['mapper']->getJoin($joinRule);

		/* Find the stuff onto which $mapper2 objects should be joined
		 */
		$mapper2 = $this->getQueryRegistry()->getMapper($rule['other']['mapper'], $otherAlias);

		/* Assemble join querystring
		 */
		$joinType = strtoupper($type);

		/* Keys are properties, so find out their column names
		 */
		$propertyDefinition = $mapper2->getProperties()->find('property', $rule['other']['property']);

		if ($propertyDefinition instanceof \App\Mapper\PropertyDefinition) {
			$property = $propertyDefinition->getColumn();
		}
		else {
			throw new \Exception("Could not find join property {$rule['other']['property']}");
		}

		$str = "
			{$joinType} JOIN {$mapper2->getTable()} {$otherAlias}
			ON {$thisAlias}.{$rule['this']['property']} = {$otherAlias}.{$property}
		";

		/* Augment query string
		 */
		$this->augmentQueryString($str);

		/* Augment object graph
		 */
		$this->addToObjectGraph(
			$thisAlias,
			$otherAlias
		);

		/* Augment list of join rules used in this query
		 */
		$this->addToRules(array(
			'name' => $joinRule,
			'rule' => $rule
		));

		return $this;
	}

	/**
	 * Where
	 *
	 * @param $clause
	 * @return $this
	 */
	public function where($clause) {
		$this->augmentQueryString('WHERE ' . $clause);

		return $this;
	}

	/**
	 * And
	 *
	 * @param $clause
	 * @return $this
	 */
	public function andWhere($clause) {
		$this->augmentQueryString('AND ' . $clause);

		return $this;
	}

	/**
	 * Or
	 *
	 * @param $clause
	 * @return $this
	 */
	public function orWhere($clause) {
		$this->augmentQueryString('OR ' . $clause);

		return $this;
	}

	/**
	 * Order
	 *
	 * @param $column
	 * @param string $order
	 * @return $this
	 */
	public function orderBy($column, $order = 'ASC') {

		/* Only permit one of two values
		 */
		if ($order != 'ASC') {
			$order = 'DESC';
		}

		$this->augmentQueryString("ORDER BY {$column} {$order}");

		return $this;
	}

	/**
	 * Limit
	 *
	 * Takes two arguments to produce a start/offset style, often seen
	 * in paginations
	 *
	 * Otherwise it can accept only one argument so you can limit query
	 * results in the ordinary way
	 *
	 * @param $start
	 * @param bool $offset
	 * @return $this
	 */
	public function limit($start, $offset = false) {
		if ($start && $offset) {
			$str = "LIMIT {$start}, {$offset}";
		}
		else {
			$str = "LIMIT {$start}";
		}

		$this->augmentQueryString($str);

		return $this;
	}

	/**
	 * Process the querystring bits as a string which can be executed
	 *
	 * @return $this
	 */
	public function prepare() {
		$this->setQuery(implode("\n", $this->getQueryString()));

		return $this;
	}

	/**
	 * Alias to set up a raw query, bypassing the join constructs and
	 * other orm-style stuff
	 *
	 * @param $querystring
	 * @return $this
	 */
	public function prepareRawQuery($querystring) {
		$this->setQuery($querystring);

		return $this;
	}

	/**
	 * Execute the query
	 *
	 * @param $allParams
	 * @return mixed
	 */
	public function execute($allParams = null) {
		$statement = $this->getDatabase()->prepare($this->getQuery());

		/* Bind params
		 */
		if (is_array($allParams) && count($allParams)) {
			foreach($allParams as $key => $value) {

				$statement->bindValue($key, $value['column'], $value['type']);
			}
		}

		$statement->execute();

		return $statement;
	}

	/**
	 * Delegate method
	 *
	 * Get the last id inserted
	 *
	 * @return mixed
	 */
	public function getLastInsertId() {
		if ($this->getDatabase()->getLastInsertId()) {
			return $this->getDatabase()->getLastInsertId();
		}

		return null;
	}

	/**
	 * Makes a relationship representation between $thisAlias and $otherAlias
	 *
	 * This makes $otherAlias an element of $thisAlias, which allows us to find
	 * out later which objects are related to which other objects
	 *
	 * @param $thisAlias
	 * @param $otherAlias
	 */
	private function addToObjectGraph($thisAlias, $otherAlias) {
		$this->objectGraph[] = array(
			'thisAlias' => $thisAlias,
			'otherAlias' => $otherAlias,
		);
	}

	/**
	 * Add to a registry of join rules used in the query
	 *
	 * @param $rule
	 */
	private function addToRules($rule) {
		$this->rules[] = $rule;
	}

	/**
	 * Add a piece to the existing query string
	 * Condense and trim multiple whitespace characters
	 *
	 * @param $string
	 */
	private function augmentQueryString($string) {
		$this->queryString[] = preg_replace('/\s+/m', ' ', trim($string));
	}

	/**
	 * Get the mapper name belonging to a particular model
	 *
	 * @param $model
	 * @return string
	 */
	private function getMapperNameFromModel($model) {
		return $model . 'Mapper';
	}

	/**
	 * Delegate method
	 *
	 * Get a mapper out of the QueryRegistry since they've already spawned
	 *
	 * @param $alias
	 * @return mixed
	 */
	public function getMapperForAlias($alias) {
		return $this->getQueryRegistry()->getMapperForAlias($alias);
	}

	/**
	 * Find a method name from a property
	 *
	 * @param $property
	 * @param $mapperName
	 * @throws \Exception
	 * @return mixed
	 */
	public function deriveSetterMethodFromProperty($property, $mapperName) {
		$mapper = new $mapperName();

		foreach($mapper->getProperties() as $current) {
			if ($current->getProperty() == $property) {
				return 'set' . ucwords($current->getProperty());
			}
		}

		throw new \Exception('Property not found via setter property.');
	}

	/**
	 * Find a method name from a property
	 *
	 * @param $property
	 * @param $mapperName
	 * @throws \Exception
	 * @return mixed
	 */
	public function deriveGetterMethodFromProperty($property, $mapperName) {
		$mapper = new $mapperName();

		foreach($mapper->getProperties() as $current) {
			if ($current->getProperty() == $property) {
				return 'get' . ucwords($current->getProperty());
			}
		}

		throw new \Exception("Property {$property} not found via getter in {$mapperName}.");
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
	 * Set query string
	 *
	 * @param array $queryString
	 */
	private function setQueryString($queryString) {
		$this->queryString = $queryString;
	}

	/**
	 * Get query string
	 *
	 * @return array
	 */
	public function getQueryString() {
		return $this->queryString;
	}

	/**
	 * Set query registry
	 *
	 * @param \App\Mapper\QueryRegistry $queryRegistry
	 */
	private function setQueryRegistry($queryRegistry) {
		$this->queryRegistry = $queryRegistry;
	}

	/**
	 * Get query registry
	 *
	 * @return \App\Mapper\QueryRegistry
	 */
	private function getQueryRegistry() {
		return $this->queryRegistry;
	}

	/**
	 * Set object graph
	 *
	 * @param array $objectGraph
	 */
	private function setObjectGraph($objectGraph) {
		$this->objectGraph = $objectGraph;
	}

	/**
	 * Get object graph
	 *
	 * @return array
	 */
	public function getObjectGraph() {
		return $this->objectGraph;
	}

	/**
	 * Set rules
	 *
	 * @param array $rules
	 */
	private function setRules($rules) {
		$this->rules = $rules;
	}

	/**
	 * Get rules
	 *
	 * @return array
	 */
	public function getRules() {
		return $this->rules;
	}

	/**
	 * Set query
	 *
	 * @param string $query
	 */
	private function setQuery($query) {
		$this->query = $query;
	}

	/**
	 * Get query
	 *
	 * @return string
	 */
	private function getQuery() {
		return $this->query;
	}
}