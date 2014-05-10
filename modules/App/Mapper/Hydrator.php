<?php
/**
 * Hydrator.php
 *
 * Date: 7/04/2014
 * Time: 10:16 PM
 */

namespace App\Mapper;


class Hydrator {

	/**
	 * A model instance to populate
	 *
	 * @var null
	 */
	private $product = null;

	/**
	 * For an $instance, hydrate all its listed properties, using the $alias
	 * referenced in the sql-fetched $row
	 *
	 * @param $instance
	 * @param $allProperties
	 * @param $alias
	 * @param $row
	 */
	public function __construct($instance, $allProperties, $alias, $row) {
		foreach($allProperties as $currentDefinition) {
			if (!$currentDefinition->isCollection()) {
				$method = $currentDefinition->deriveMethod();
				$column = $this->getAliasedColumn($alias, $currentDefinition->getColumn());

				$instance->$method($row[$column]);
			}
		}

		$this->setProduct($instance);
	}

	/**
	 * Get the aliased column reference, used when hydrating
	 *
	 * @param $alias
	 * @param $column
	 * @return string
	 */
	private function getAliasedColumn($alias, $column) {
		return $alias . '__' . $column;
	}

	/* Getters/Setters
	 */

	/**
	 * Set product
	 *
	 * @param null $product
	 */
	private function setProduct($product) {
		$this->product = $product;
	}

	/**
	 * Get product
	 *
	 * @return null
	 */
	public function getProduct() {
		return $this->product;
	}
} 