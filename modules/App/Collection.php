<?php
/**
 * Collection.php
 *
 * Date: 15/01/2014
 * Time: 1:15 AM
 */

namespace App;


class Collection implements \Iterator, \JsonSerializable {

	/**
	 * Current position
	 *
	 * @var int
	 */
	protected $position = 0;

	/**
	 * A stack of items
	 *
	 * @var array
	 */
	protected $stack = array();

	/**
	 * Number of items in the stack
	 *
	 * @return int
	 */
	public function length() {
		return count($this->stack);
	}

	/**
	 * Get the first element
	 *
	 * @return mixed
	 */
	public function first() {
		if (isset($this->stack[0])) {
			return $this->stack[0];
		}
	}

	/**
	 * json-encode the current stack's items
	 *
	 * @return string
	 */
	public function jsonSerialize() {
		$encoded = array();

		foreach($this->getStack() as $currentItem) {
			$encoded[] = $currentItem->jsonSerialize();
		}

		return json_encode($encoded);
	}

	/**
	 * Get the last element
	 *
	 * @return mixed
	 */
	public function last() {
		$index = count($this->stack);

		if (isset($this->stack[$index-1])) {
			return $this->stack[$index-1];
		}
	}

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

	/* Getters/Setters
	 */

	/**
	 * Set stack
	 *
	 * @param array $stack
	 */
	public function setStack($stack) {
		$this->stack = $stack;
	}

	/**
	 * Get stack
	 *
	 * @return array
	 */
	public function getStack() {
		return $this->stack;
	}
}