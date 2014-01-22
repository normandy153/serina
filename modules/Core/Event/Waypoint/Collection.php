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
	private $maxItems = 4;

	/**
	 * An instance of \App\Collection
	 *
	 * @var null
	 */
	private $allCollections = null;

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/**
	 * Break full stack into substacks
	 *
	 * @return \App\Collection
	 */
	public function regroup() {
		$allCollections = new \App\Collection();

		if ($this->length()) {
			$currentCollection = new \App\Collection();
			$i = 1;

			/* Each currentCollection holds maxItems
			 *
			 * Last element of the previous Collection is the first element
			 * of the next, for polyfill continuity
			 */
			foreach($this as $currentItem) {
				if ($i && !($i % $this->getMaxItems())) {
					$currentCollection->add($currentItem);

					$allCollections->add($currentCollection);

					/* Reset for next batch
					 */
					$currentCollection = new \App\Collection();
				}

				$currentCollection->add($currentItem);

				$i++;
			}
		}

		/* A Collection of Collections
		 */
		$this->setAllCollections($allCollections);
	}

	/**
	 * Encode all added Nodes into a single polyfill
	 */
	public function transcode() {
		$curl = new \App\Curl($this->retrieveUrl());

		$result = $curl->exec()->getResult();
		$errors = $curl->exec()->getErrors();

		/* json_decode google response data
		 * Remember it
		 */
		if (!strlen($errors)) {
			$data = json_decode($result);

			$this->setEncodedPolyfill($data->routes[0]->overview_polyline->points);
		}
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

	/**
	 * Set max items
	 *
	 * @param int $maxItems
	 */
	private function setMaxItems($maxItems) {
		$this->maxItems = $maxItems;
	}

	/**
	 * Get max items
	 *
	 * @return int
	 */
	private function getMaxItems() {
		return $this->maxItems;
	}

	/**
	 * Set all collections
	 *
	 * @param null $allCollections
	 */
	private function setAllCollections($allCollections) {
		$this->allCollections = $allCollections;
	}

	/**
	 * Get all collections
	 *
	 * @return null
	 */
	private function getAllCollections() {
		return $this->allCollections;
	}
}