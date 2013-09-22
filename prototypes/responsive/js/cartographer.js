/**
 * Google Maps API Wrapper
 */
(function($) {
	$.fn.cartographer = function(locations) {
		var config = init($(this), locations);

		plot();
		addMarkers();

		/**
		 * Init
		 */
		function init(element, locations) {
			var defaults = {}

			var derived = {
				element: element,
				locations: locations,
				map: ''
			}

			var merged = $.extend(defaults, derived);

			return merged;
		}

		/**
		 * Plot markers
		 *
		 * @param locations
		 */
		function getBounds() {
			var bounds = new google.maps.LatLngBounds();

			for (var i = 0; i < config.locations.length; i++) {
				var currentLocation = config.locations[i];

				var coords = new google.maps.LatLng(currentLocation.latitude, currentLocation.longitude);

				bounds.extend(coords);
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
				mapTypeId: google.maps.MapTypeId.SATELLITE
			};

			var map = new google.maps.Map(document.getElementById(config.element.attr('id')), mapOptions);
			map.fitBounds(getBounds());

			config.map = map;
		}

		/**
		 * Add markers/points of interest
		 */
		function addMarkers() {
			for (var i = 0; i < config.locations.length; i++) {
				var currentLocation = config.locations[i];

				var marker = new google.maps.Marker({
					title: currentLocation.title,
					position: new google.maps.LatLng(currentLocation.latitude, currentLocation.longitude),
					map: config.map
				});
			}
		}
	}
}(jQuery));