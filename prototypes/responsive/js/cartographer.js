
/**
 * Google Maps API Wrapper
 */
(function($) {
	$.fn.cartographer = function(locations) {
		var config = init($(this), locations);

		/* Geocode everything first
		 */
		preprocess();

		/* Poll processedLocations list to see whether all geocoding
		 * has been done asynchronously
		 */
		var mapTimeout = setInterval(facade, 1000);

		/**
		 * Init
		 */
		function init(element, locations) {
			var defaults = {}

			var derived = {
				element: element,
				locations: locations,
				processedLocations: [],
				map: ''
			}

			var merged = $.extend(defaults, derived);

			return merged;
		}

		/**
		 * Preprocess one location
		 *
		 * @param geocoder
		 * @param currentLocation
		 */
		function preprocessOne(index, geocoder, currentLocation) {

			/* Geocode addresses
			 */
			if (currentLocation.geocode == true) {
				geocoder.geocode({'address': currentLocation.address}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						var newElement = {
							title: currentLocation.title,
							latitude: results[0].geometry.location.ob,
							longitude: results[0].geometry.location.pb
						}

						config.processedLocations[index] = newElement;
					}
					/* When there are no results, add a null element
					 * so the other markers plot anyway
					 */
					else{
						var newElement = {
						}

						config.processedLocations[index] = newElement;
					}
				});
			}
			else {
				var newElement = {
					title: currentLocation.title,
					latitude: currentLocation.latitude,
					longitude: currentLocation.longitude
				}

				config.processedLocations[index] = newElement;
			}
		}

		/**
		 * Perform any geocoding and restack
		 */
		function preprocess() {
			var geocoder = new google.maps.Geocoder();

			for (var i = 0; i < config.locations.length; i++) {
				preprocessOne(i, geocoder, config.locations[i]);
			}
		}

		/**
		 * Plot markers
		 *
		 * @param locations
		 */
		function getBounds() {
			var bounds = new google.maps.LatLngBounds();

			for (var i = 0; i < config.processedLocations.length; i++) {
				var currentLocation = config.processedLocations[i];

				if (currentLocation.latitude != undefined) {
					var coords = new google.maps.LatLng(currentLocation.latitude, currentLocation.longitude);
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
		 * Add markers/points of interest
		 */
		function addMarkers() {
			for (var i = 0; i < config.processedLocations.length; i++) {
				var currentLocation = config.processedLocations[i];

				if (currentLocation.latitude != undefined) {
					var marker = new google.maps.Marker({
						title: currentLocation.title,
						position: new google.maps.LatLng(currentLocation.latitude, currentLocation.longitude),
						map: config.map
					});
				}
			}
		}

		function route(directionsService, directionsDisplay, start, end, type) {
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
		function addRoute() {
			var directionsService = new google.maps.DirectionsService();

			for (var i = 1; i < config.processedLocations.length; i++) {
				var directionsDisplay = new google.maps.DirectionsRenderer({
					suppressMarkers: true,
					preserveViewport: true
				});

				directionsDisplay.setMap(config.map);

				var previousLocation = config.processedLocations[i-1];
				var currentLocation = config.processedLocations[i];

				var start = new google.maps.LatLng(previousLocation.latitude, previousLocation.longitude);
				var end = new google.maps.LatLng(currentLocation.latitude, currentLocation.longitude);

				route(directionsService, directionsDisplay, start, end, 'DRIVING');
			}
		}
		/**
		 * Facade method to circumvent timing
		 */
		function facade() {
			if (config.processedLocations.length == config.locations.length) {
				plot();
				addRoute();
				addMarkers();
				clearTimeout(mapTimeout);
			}
		}
	}
}(jQuery));

