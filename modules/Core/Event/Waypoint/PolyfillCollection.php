<?php
/**
 * PolyfillCollection
 *
 * A collection of PolyfillNodes which get converted into Polyfill objects
 *
 * Date: 21/01/2014
 * Time: 11:28 PM
 */

namespace Core\Event\Waypoint;

use App\Collection;
use App\Curl;

class PolyfillCollection extends Collection {

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
	 * Encoded polyfill for the Nodes contained within
	 *
	 * @var \App\Collection
	 */
	private $allEncodedPolyfills = null;

	/**
	 * An instance of \App\Collection
	 *
	 * @var \App\Collection
	 */
	private $allCollections = null;

	/**
	 * Constructor
	 *
	 * Construct a collection of Nodes from an array of addresses
	 *
	 * @param $allWaypoints
	 */
	public function __construct(Collection $allWaypoints) {
		foreach($allWaypoints as $currentWaypoint) {
			$node = new PolyfillNode();
			$node->setAddress($currentWaypoint->getAddress());
			$this->add($node);
		}
	}

	/**
	 * Break full stack into substacks
	 *
	 * @return \App\Collection
	 */
	private function regroup() {
		$allCollections = new Collection();

		if ($this->length()) {
			$currentCollection = new Collection();
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
					$currentCollection = new Collection();
				}

				$currentCollection->add($currentItem);

				$i++;
			}

			/* Any remainders not already added
			 */
			$allCollections->add($currentCollection);
		}

		/* A Collection of Collections
		 */
		$this->setAllCollections($allCollections);
	}

	/**
	 * Derive a url for Google Maps API
	 * This encodes all the waypoints between an origin and a destination
	 *
	 * @return string
	 */
	private function retrieveUrls() {
		$allUrls = new Collection();

		/* Process each group of Nodes
		 */
		foreach($this->getAllCollections() as $currentCollection) {

			/* A start and end Node must exist
			 */
			if ($currentCollection->length() >= 2) {
				$waypoints = array();

				/* Multiple waypoints exist
				 */
				if ($this->length() > 2) {
					for ($i = 1; $i < $currentCollection->length()-1; $i++) {
						$currentNode = $currentCollection->stack[$i];

						$waypoints[] = $currentNode->getAddress();
					}
				}

				/* Combine them all
				 */
				$origin = urlencode($currentCollection->first()->getAddress());
				$allWaypoints = urlencode(implode('|', $waypoints));
				$destination = urlencode($currentCollection->last()->getAddress());

				/* Inject them into the url
				 */
				$url = strtr($this->getApiUrl(), array(
					'{ORIGIN}' => $origin,
					'{WAYPOINTS}' => $allWaypoints,
					'{DESTINATION}' => $destination
				));

				/* Keep a register of all urls that need curling
				 */
				$allUrls->add($url);
			}
		}

		return $allUrls;
	}

	/**
	 * Encode all added Nodes into a single polyfill
	 */
	public function transcode() {

		/* Assemble a Collection of Collections, for Google Maps API
		 */
		$this->regroup();

		/* A collection of polyfills
		 */
		$allEncodedPolyfills = new Collection();

		/* Process each polyfill url individually
		 */
		$allUrls = $this->retrieveUrls();

		foreach($allUrls as $currentUrl) {
			$curl = new Curl($currentUrl);

			$result = $curl->exec()->getResult();
			$errors = $curl->exec()->getErrors();

			/* json_decode google response data
			 * Remember it
			 */
			if (!strlen($errors)) {
				$data = json_decode($result);

				/* Add polyfill. If it can't figure out the address, it'll
				 * give you a stdClass object with status ZERO_RESULTS
				 */
				if ($data->status !== "ZERO_RESULTS") {
					$polyfill = new Polyfill($data->routes[0]->overview_polyline->points, $data->routes[0]->bounds);
					$allEncodedPolyfills->add($polyfill);
				}
				else {

					/* TODO: Find actual addresses which cause errors
					 */
				}
			}
		}

		/* Store all the polyfill results
		 */
		$this->setAllEncodedPolyfills($allEncodedPolyfills);
	}

	/* Getters/Setters
	 */

	/**
	 * Set encoded polyfill
	 *
	 * @param \App\Collection $allEncodedPolyfills
	 */
	public function setAllEncodedPolyfills($allEncodedPolyfills) {
		$this->allEncodedPolyfills = $allEncodedPolyfills;
	}

	/**
	 * Get encoded polyfill
	 *
	 * @return \App\Collection
	 */
	public function getAllEncodedPolyfills() {
		return $this->allEncodedPolyfills;
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