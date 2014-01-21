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

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $this->retrieveUrl());
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($curl);

		new \App\Probe($this->retrieveUrl());
		new \App\Probe($result);
	}

	private function retrieveUrl() {
		$waypoints = array();

		for ($i = 1; $i < count($this->getStack())-2; $i++) {
			$currentNode = $this->stack[$i];

			$waypoints[] = $currentNode->getAddress();
		}

		$origin = urlencode($this->stack[0]->getAddress());
		$allWaypoints = urlencode(implode('|', $waypoints));
		$destination = urlencode($this->stack[count($this->stack)-1]->getAddress());

		$url = 'http://maps.googleapis.com/maps/api/directions/json?sensor=false&origin={ORIGIN}&waypoints={WAYPOINTS}&destination={DESTINATION}';

		$url = strtr($url, array(
			'{ORIGIN}' => $origin,
			'{WAYPOINTS}' => $allWaypoints,
			'{DESTINATION}' => $destination
		));

		return $url;
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