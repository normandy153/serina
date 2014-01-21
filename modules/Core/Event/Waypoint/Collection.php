<?php
/**
 * Collection.php
 *
 * Date: 21/01/2014
 * Time: 11:28 PM
 */

namespace Core\Event\Waypoint;


class Collection extends \App\Collection {

	/**
	 * Encoded polyfill for the Nodes contained within
	 *
	 * @var string
	 */
	private $encoded = '';

	/**
	 * Maximum number of transcodeable Nodes
	 *
	 * @var int
	 */
	private $maxItems = 8;

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/**
	 * Encode all added Nodes into a single polyfill
	 */
	public function transcode() {
		foreach($this->getStack() as $currentNode) {
			new \App\Probe($currentNode);
		}

	}

	/* Getters/Setters
	 */

	/**
	 * Set encoded polyfill
	 *
	 * @param string $encoded
	 */
	public function setEncoded($encoded) {
		$this->encoded = $encoded;
	}

	/**
	 * Get encoded polyfill
	 *
	 * @return string
	 */
	public function getEncoded() {
		return $this->encoded;
	}
} 