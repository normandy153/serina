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
				$replace = array(
					$currentProperty->getColumn(),
					$alias
				);

				$string[] = str_replace($pattern, $replace, $template);
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
	public function from($from) {
		list($model, $alias) = explode(' ', $from);

		/* Spawn a mapper to get to the model property definitions
		 * and to find the table name. Add to registry if it doesn't
		 * already exist there
		 */
		$mapper = $this->getQueryRegistry()->getMapper($model, $alias);

		/* Augment query string
		 */
		$this->augmentQueryString('FROM');
		$this->augmentQueryString("`{$mapper->getTable()}` {$alias}");

		return $this;
	}

	/**
	 * Alias to join()
	 *
	 * @param $thisModel
	 * @param $joinRule
	 * @return $this
	 */
	public function leftJoin($thisModel, $joinRule) {
		return $this->join('left', $thisModel, $joinRule);
	}

	/**
	 * Alias to join()
	 *
	 * @param $thisModel
	 * @param $joinRule
	 * @return $this
	 */
	public function innerJoin($thisModel, $joinRule) {
		return $this->join('inner', $thisModel, $joinRule);
	}

	/**
	 * Join
	 *
	 * Joins the left model onto another specified in left model's $joinRule
	 * This is left centric; the $rootModel contains the relationship rule
	 *
	 * @param $type
	 * @param $thisModel
	 * @param $joinRule
	 * @return $this
	 */
	private function join($type, $thisModel, $joinRule) {
		list($thisModel, $thisAlias) = explode(' ', $thisModel);

		/* Spawn a mapper to get to the model property definitions
		 * and to find the table name
		 */
		$mapper1 = $this->getQueryRegistry()->getMapper($this->getMapperNameFromModel($thisModel), $thisAlias);

		/* Find out about the other table to join upon
		 * Look up the rule from the leftmost mapper in the relation
		 */
		list($ruleName, $otherAlias) = explode(' ', $joinRule);

		$rule = $mapper1->getJoin($ruleName);

		/* Find the stuff onto which $mapper2 objects should be joined
		 */
		$mapper2 = $this->getQueryRegistry()->getMapper($rule['other']['mapper'], $otherAlias);

		/* Assemble join querystring
		 */
		$joinType = strtoupper($type);

		$str = "
			{$joinType} JOIN {$mapper2->getTable()} {$otherAlias}
			ON {$thisAlias}.{$rule['this']['key']} = {$otherAlias}.{$rule['other']['key']}
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
			'name' => $ruleName,
			'rule' => $rule
		));

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
	 * Makes a relationship representation between $rootAlias and $otherAlias
	 *
	 * This makes $otherAlias an element of $rootAlias, which allows us to find
	 * out later which objects are related to which other objects
	 *
	 * @param $rootAlias
	 * @param $otherAlias
	 */
	private function addToObjectGraph($rootAlias, $otherAlias) {
		$this->objectGraph[] = array(
			'thisAlias' => $rootAlias,
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
	 * @param $model
	 * @param $alias
	 * @return mixed
	 */
	public function getMapper($model, $alias) {
		return $this->getQueryRegistry()->getMapper($model, $alias);
	}

	/**
	 * Find a method name from a property
	 *
	 * @param $column
	 * @param $mapperName
	 * @throws \Exception
	 * @return mixed
	 */
	public function deriveSetterMethodFromColumn($column, $mapperName) {
		$mapper = new $mapperName();

		foreach($mapper->getProperties() as $current) {
			if ($current->getColumn() == $column) {
				return 'set' . ucwords($current->getProperty());
			}
		}

		throw new \Exception('Column not found via setter property.');
	}

	/**
	 * Find a method name from a property
	 *
	 * @param $column
	 * @param $mapperName
	 * @throws \Exception
	 * @return mixed
	 */
	public function deriveGetterMethodFromColumn($column, $mapperName) {
		$mapper = new $mapperName();

		foreach($mapper->getProperties() as $current) {
			if ($current->getColumn() == $column) {
				return 'get' . ucwords($current->getProperty());
			}
		}

		throw new \Exception('Column not found via getter property.');
	}

	/* Getters/Setters
	 */

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
	private function getQueryString() {
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
	public function setRules($rules) {
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
	public function getQuery() {
		return $this->query;
	}
}