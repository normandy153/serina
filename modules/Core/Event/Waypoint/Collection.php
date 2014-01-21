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
	private $encodedPolyfill = '';

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
		$url = array();

		foreach($this->getStack() as $currentNode) {
			$url[] = $currentNode->getAddress();
		}

		$suffix = implode('|', $url);

		new \App\Probe($suffix);
	}

	/* Getters/Setters
	 */

	/**
	 * Set encoded polyfill
	 *
	 * @param string $encodedPolyfill
	 */
	public function setEncodedPolyfill($encodedPolyfill) {
		$this->encodedPolyfill = $encodedPolyfill;
	}

	/**
	 * Get encoded polyfill
	 *
	 * @return string
	 */
	public function getEncodedPolyfill() {
		return $this->encodedPolyfill;
	}



} 