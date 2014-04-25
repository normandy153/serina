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
	 * Constructor
	 */
	public function __construct() {
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
			$mapperClass = $model . 'Mapper';
			$mapper = new $mapperClass();

			foreach ($mapper->getProperties() as $currentProperty) {
				$replace = array(
					$currentProperty->getColumn(),
					$alias
				);

				$string[] = str_replace($pattern, $replace, $template);
			}
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
		 * and to find the table name
		 */
		$mapperClass = $model . 'Mapper';
		$mapper = new $mapperClass();

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
		$mapperClass = $rootModel . 'Mapper';
		$mapper1 = new $mapperClass();

		$rule = $mapper1->getJoin($joinRule);

		/* Find the stuff onto which $mapper2 objects should be joined
		 */
		$mapperClass = $rule['other']['model'] . 'Mapper';
		$mapper2 = new $mapperClass();

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
} 