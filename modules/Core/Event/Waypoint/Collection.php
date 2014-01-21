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
	 * The Google Maps API Url
	 *
	 * @var string
	 */
	private $apiUrl = 'http://maps.googleapis.com/maps/api/directions/json?sensor=false&origin={ORIGIN}&waypoints={WAYPOINTS}&destination={DESTINATION}';

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

		$curl = new \App\Curl($this->retrieveUrl());

		$result = $curl->exec()->getResult();
		$errors = $curl->exec()->getErrors();

		new \App\Probe($result);
		new \App\Probe($errors);
	}

	/**
	 * Derive a url for Google Maps API
	 * This encodes all the waypoints between an origin and a destination
	 *
	 * @return string
	 */
	private function retrieveUrl() {
		$url = '';

		/* A start and end Node must exist
		 */
		if ($this->length() >= 2) {
			$waypoints = array();

			/* Multiple waypoints exist
			 */
			if ($this->length() > 2) {
				for ($i = 1; $i < $this->length()-1; $i++) {
					$currentNode = $this->stack[$i];

					$waypoints[] = $currentNode->getAddress();
				}
			}

			/* Combine them all
			 */
			$origin = urlencode($this->first()->getAddress());
			$allWaypoints = urlencode(implode('|', $waypoints));
			$destination = urlencode($this->last()->getAddress());

			/* Inject them into the url
			 */
			$url = strtr($this->getApiUrl(), array(
				'{ORIGIN}' => $origin,
				'{WAYPOINTS}' => $allWaypoints,
				'{DESTINATION}' => $destination
			));
		}

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

	/**
	 * Set api url
	 *
	 * @param string $apiUrl
	 */
	private function setApiUrl($apiUrl) {
		$this->apiUrl = $apiUrl;
	}

	/**
	 * Get api url
	 *
	 * @return string
	 */
	private function getApiUrl() {
		return $this->apiUrl;
	}
}