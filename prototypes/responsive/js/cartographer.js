
/**
 * Google Maps API Wrapper
 */
(function($) {
	$.fn.cartographer = function(locations) {
		var config = init($(this), locations);

		/* Geocode everything first
		 */
		preprocess();

		/* Poll processedWaypoints list to see whether all geocoding
		 * has been done asynchronously
		 */
		var mapTimeout = setInterval(facade, 1000);

		/**
		 * Init
		 */
		function init(element, locations) {
			var defaults = {}

			var derived = {
				map: '',
				element: element,
				locations: locations,

				/* This caters for asynchronous geocoding
				 */
				processedWaypoints: []
			}

			var merged = $.extend(defaults, derived);

			return merged;
		}

		/**
		 * Preprocess one location
		 *
		 * @param geocoder
		 * @param currentWaypoint
		 */
		function preprocessOne(index, geocoder, currentWaypoint) {

			/* Geocode addresses
			 */
			if (currentWaypoint.geocode == true) {
				geocoder.geocode({'address': currentWaypoint.address}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						var newElement = {
							title: currentWaypoint.title,
							latitude: results[0].geometry.location.lat(),
							longitude: results[0].geometry.location.lng()
						}

						config.processedWaypoints[index] = newElement;
					}
					/* When there are no results, add a null element
					 * so the other markers plot anyway
					 */
					else{
						var newElement = {
						}

						config.processedWaypoints[index] = newElement;
					}
				});
			}
			else {
				var newElement = {
					title: currentWaypoint.title,
					latitude: currentWaypoint.latitude,
					longitude: currentWaypoint.longitude
				}

				config.processedWaypoints[index] = newElement;
			}
		}

		/**
		 * Perform any geocoding and restack
		 */
		function preprocess() {
			var geocoder = new google.maps.Geocoder();

			for (var i = 0; i < config.locations.waypoints.length; i++) {
				preprocessOne(i, geocoder, config.locations.waypoints[i]);
			}
		}

		/**
		 * Plot markers
		 *
		 * @param waypoints
		 */
		function getBounds() {
			var bounds = new google.maps.LatLngBounds();

			for (var i = 0; i < config.processedWaypoints.length; i++) {
				var currentWaypoint = config.processedWaypoints[i];

				if (currentWaypoint.latitude != undefined) {
					var coords = new google.maps.LatLng(currentWaypoint.latitude, currentWaypoint.longitude);
					bounds.extend(coords);
				}
			}

			/* Prevent mega-zoom with one marker
			 */
			if (bounds.getNorthEast().equals(bounds.getSouthWest())) {
				var extendPoint1 = new google.maps.LatLng(bounds.getNorthEast().lat() + 0.01, bounds.getNorthEast().lng() + 0.01);
				var extendPoint2 = new google.maps.LatLng(bounds.getNorthEast().lat() - 0.01, bounds.getNorthEast().lng() - 0.01);
				bounds.extend(extendPoint1);
				bounds.extend(extendPoint2);
			}

			return bounds;
		}

		/**
		 * Plot That Map
		 */
		function plot() {
			var mapOptions = {
				mapTypeId: google.maps.MapTypeId.MAP
			};

			var map = new google.maps.Map(document.getElementById(config.element.attr('id')), mapOptions);
			map.fitBounds(getBounds());

			config.map = map;
		}

		/**
		 * Add one marker
		 *
		 * @param currentWaypoint
		 */
		function addMarker(currentCoordinate, image) {
			if (currentCoordinate.latitude != undefined) {
				var definition = {
					title: currentCoordinate.title,
					icon: image,
					position: new google.maps.LatLng(currentCoordinate.latitude, currentCoordinate.longitude),
					map: config.map
				}

				/* If a custom image was chosen, otherwise use default
				 */
				if (image !== null) {
					definition.image = image;
				}

				var marker = new google.maps.Marker(definition);
			}
		}

		/**
		 * Add a point of interest to the map
		 *
		 * @param currentCoordinate
		 */
		function addPointOfInterest(currentCoordinate) {
			addMarker(currentCoordinate, './images/star-3.png');
		}

		/**
		 * Add all waypoints to the map
		 */
		function addPointsOfInterest() {
			for (var i = 0; i < config.locations.pointsOfInterest.length; i++) {
				addPointOfInterest(config.locations.pointsOfInterest[i]);
			}
		}

		/**
		 * Add a waypoint style to the map
		 *
		 * @param currentCoordinate
		 */
		function addWaypoint(currentCoordinate) {
			addMarker(currentCoordinate, null);
		}

		/**
		 * Add all waypoints to the map
		 */
		function addWaypoints() {
			for (var i = 0; i < config.processedWaypoints.length; i++) {
				addWaypoint(config.processedWaypoints[i]);
			}
		}

		/**
		 * Draw a line between two locations
		 *
		 * @param directionsService
		 * @param directionsDisplay
		 * @param start
		 * @param end
		 * @param type
		 */
		function addRoute(directionsService, directionsDisplay, start, end, type) {
			var request = {
				origin: start,
				destination: end,

				// Note that Javascript allows us to access the constant
				// using square brackets and a string value as its
				// "property."
				travelMode: google.maps.DirectionsTravelMode.DRIVING
			};

			directionsService.route(request, function(response, status) {
				if (status == google.maps.DirectionsStatus.OK) {
					directionsDisplay.setDirections(response);
				}
			});
		}

		/**
		 * Draw route between two points
		 */
		function addRoutes() {
			var directionsService = new google.maps.DirectionsService();

			for (var i = 1; i < config.processedWaypoints.length; i++) {
				var directionsDisplay = new google.maps.DirectionsRenderer({
					suppressMarkers: true,
					preserveViewport: true
				});

				directionsDisplay.setMap(config.map);

				var previousWaypoint = config.processedWaypoints[i-1];
				var currentWaypoint = config.processedWaypoints[i];

				var start = new google.maps.LatLng(previousWaypoint.latitude, previousWaypoint.longitude);
				var end = new google.maps.LatLng(currentWaypoint.latitude, currentWaypoint.longitude);

				addRoute(directionsService, directionsDisplay, start, end, 'DRIVING');
			}
		}
		/**
		 * Facade method to circumvent timing
		 */
		function facade() {
			if (config.processedWaypoints.length == config.locations.waypoints.length) {
				plot();
				addRoutes();
				addWaypoints();
				addPointsOfInterest();
				clearTimeout(mapTimeout);
			}
		}
	}
}(jQuery));

