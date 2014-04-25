<?php
/**
 * QueryRegistry.php
 *
 * Date: 25/04/2014
 * Time: 4:12 PM
 */

namespace App\Mapper;


class QueryRegistry {

	/**
	 * A list of model/alias pairs
	 *
	 * @var array
	 */
	private $registry = array();

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	/**
	 * Add a model to the registry for a particular alias
	 *
	 * @param $alias
	 * @param $model
	 */
	public function addModel($alias, $model) {
		$this->registry[$alias]['model'] = $model;
	}

	/**
	 * Add a mapper to the registry for a particular alias
	 *
	 * @param $alias
	 * @param $mapper
	 */
	public function addMapper($alias, $mapper) {
		$this->registry[$alias]['mapper'] = $mapper;
	}

	/**
	 * Get a mapper out of the registry, spawning and remembering an instance
	 * of one if it didn't already exist
	 *
	 * @param $model
	 * @param $alias
	 * @return mixed
	 */
	public function getMapper($model, $alias) {

		/* If the alias wasn't known, spawn some defaults
		 */
		if (!isset($this->registry[$alias])) {
			$this->registry[$alias] = array(
				'model' => false,
				'mapper' => false,
			);
		}

		/* Try to get an existing mapper
		 */
		$mapper = $this->registry[$alias]['mapper'];

		if (!$mapper) {
			$mapper = $this->getMapperClassFromModel($model);

			/* Remember instances of everything we found in the select
  			 */
			$this->addModel($alias, $model);
			$this->addMapper($alias, $mapper);
		}

		return $this->registry[$alias]['mapper'];
	}

	/**
	 * Spawn a mapper class from model name
	 *
	 * @param $modelName
	 * @throws \Exception
	 * @return mixed
	 */
	public function getMapperClassFromModel($modelName) {
		$mapperClass = $modelName . 'Mapper';

		if (class_exists($mapperClass)) {
			return new $mapperClass();
		}

		throw new \Exception("Mapper class $mapperClass does not exist.");
	}
} 