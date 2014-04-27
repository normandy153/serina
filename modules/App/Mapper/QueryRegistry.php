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
	 * @param $mapperName
	 * @param $alias
	 * @return mixed
	 */
	public function getMapper($mapperName, $alias) {

		/* If the alias wasn't known, spawn some defaults
		 */
		if (!isset($this->registry[$alias])) {
			$this->registry[$alias] = array(
				'model' => false,
				'mapper' => false,
			);
		}

		/* Try to get an existing mapper
		 * Spawn and register one if it doesn't exist
		 */
		$existingMapper = $this->registry[$alias]['mapper'];

		if (!$existingMapper) {
			$mapperInstance = $this->getMapperInstance($mapperName);

			/* Remember instances of everything we found in the select
  			 */
			$this->addModel($alias, $mapperInstance->getModel());
			$this->addMapper($alias, $mapperInstance);
		}

		return $this->registry[$alias]['mapper'];
	}

	/**
	 * Spawn a mapper class
	 *
	 * @param $mapper
	 * @throws \Exception
	 * @return mixed
	 */
	public function getMapperInstance($mapper) {
		if (class_exists($mapper)) {
			return new $mapper();
		}

		throw new \Exception("Mapper class: $mapper does not exist.");
	}
} 