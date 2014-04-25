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
			$mapper = $this->getQueryRegistry()->getMapper($model, $alias);

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
	 * @param $rootModel
	 * @param $joinRule
	 * @param $otherAlias
	 * @return $this
	 */
	public function leftJoin($rootModel, $joinRule, $otherAlias) {
		return $this->join('left', $rootModel, $joinRule, $otherAlias);
	}

	/**
	 * Alias to join()
	 *
	 * @param $rootModel
	 * @param $joinRule
	 * @param $otherAlias
	 * @return $this
	 */
	public function innerJoin($rootModel, $joinRule, $otherAlias) {
		return $this->join('inner', $rootModel, $joinRule, $otherAlias);
	}

	/**
	 * Join
	 *
	 * Joins the left model onto another specified in left model's $joinRule
	 * This is left centric; the $rootModel contains the relationship rule
	 *
	 * @param $type
	 * @param $rootModel
	 * @param $joinRule
	 * @param $otherAlias
	 * @return $this
	 */
	private function join($type, $rootModel, $joinRule, $otherAlias) {
		list($rootModel, $rootAlias) = explode(' ', $rootModel);

		/* Spawn a mapper to get to the model property definitions
		 * and to find the table name
		 */
		$mapper1 = $this->getQueryRegistry()->getMapper($rootModel, $rootAlias);

		/* Find out about the other table to join upon
		 */
		$rule = $mapper1->getJoin($joinRule);

		/* Find the stuff onto which $mapper2 objects should be joined
		 */
		$mapper2 = $this->getQueryRegistry()->getMapper($rule['other']['model'], $otherAlias);

		/* Assemble join querystring
		 */
		$joinType = strtoupper($type);

		$str = "
			{$joinType} JOIN {$mapper2->getTable()} {$otherAlias}
			ON {$rootAlias}.{$rule['this']['key']} = {$otherAlias}.{$rule['other']['key']}
		";

		/* Augment query string
		 */
		$this->augmentQueryString($str);

		return $this;
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
} 