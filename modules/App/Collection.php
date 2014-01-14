<?php
/**
 * Collection.php
 *
 * Date: 15/01/2014
 * Time: 1:15 AM
 */

namespace App;


class Collection implements \Iterator {

	/**
	 * Current position
	 *
	 * @var int
	 */
	private $position = 0;

	/**
	 * A stack of items
	 *
	 * @var array
	 */
	private $stack = array();

	/**
	 * Add an item onto the end
	 *
	 * @param $item
	 */
	public function add($item) {
		$this->stack[] = $item;
	}

	/**
	 * Is the current element valid?
	 *
	 * @return bool
	 */
	public function valid() {
		if (isset($this->stack[$this->position])) {
			return true;
		}

		return false;
	}

	/**
	 * Go to next elment
	 */
	public function next() {
		++$this->position;
	}

	/**
	 * Rewind back to the start
	 */
	public function rewind() {
		$this->position = 0;
	}

	/**
	 * Get the current element
	 *
	 * @return mixed
	 */
	public function current() {
		return $this->stack[$this->position];
	}

	/**
	 * The current index
	 *
	 * @return int|mixed
	 */
	public function key() {
		return $this->position;
	}
}