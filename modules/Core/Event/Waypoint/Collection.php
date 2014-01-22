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
	private $allEncodedPolyfills = '';

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
	private function regroup() {
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
	 * Derive a url for Google Maps API
	 * This encodes all the waypoints between an origin and a destination
	 *
	 * @return string
	 */
	private function retrieveUrls() {
		$allUrls = new \App\Collection();

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
		$allEncodedPolyfills = new \App\Collection();

		/* Process each polyfill url individually
		 */
		foreach($this->retrieveUrls() as $currentUrl) {
			$curl = new \App\Curl($currentUrl);

			$result = $curl->exec()->getResult();
			$errors = $curl->exec()->getErrors();

			/* json_decode google response data
			 * Remember it
			 */
			if (!strlen($errors)) {
				$data = json_decode($result);

				$allEncodedPolyfills->add($data->routes[0]->overview_polyline->points);
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
	 * @param string $allEncodedPolyfills
	 */
	public function setAllEncodedPolyfills($allEncodedPolyfills) {
		$this->allEncodedPolyfills = $allEncodedPolyfills;
	}

	/**
	 * Get encoded polyfill
	 *
	 * @return string
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