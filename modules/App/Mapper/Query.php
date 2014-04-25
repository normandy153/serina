<?php
/**
 * Query.php
 *
 * Date: 25/04/2014
 * Time: 2:04 PM
 */


//$query
//	->select('User u', 'Address a', 'State s', 'Phone p')
//	->from('u')
//	->join('User Address')
//	->join('Address State')
//	->join('User Phone')
//	->execute();

namespace App\Mapper;


class Query {

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
	 * @return string
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

		return $str;
	}
} 