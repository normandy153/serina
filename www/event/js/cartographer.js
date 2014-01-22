/**
 * Google Maps API Wrapper
 */
(function($) {
    $.fn.cartographer = function(options) {

        /* Accept optional parameter
         */
        options = options || {}

        var config = init($(this), options);

        /* Set up map canvas
         */
        setupCanvas();

        /* Plot polyfills and center map
         */
        plotRoutes();

        /**
         * Init
         */
        function init(element, options) {
            var defaults = {
                map: '',
                element: element,
                bounds: [],
                polyfills: []
            }

            var derived = {
            }

            var merged = $.extend(defaults, derived, options);

            return merged;
        }

        /**
         * Determine bounding box for plotted polyfills
         */
        function getBounds() {
            var bounds = new google.maps.LatLngBounds();

            for (var i = 0; i < config.bounds.length; i++) {
                var coords = new google.maps.LatLng(config.bounds[i].northeast.lat, config.bounds[i].northeast.lng);
                bounds.extend(coords);

                var coords = new google.maps.LatLng(config.bounds[i].southwest.lat, config.bounds[i].southwest.lng);
                bounds.extend(coords);
            }

            return bounds;
        }

        /**
         * Plot polyfills on map canvas
         */
        function plotRoutes() {
            for (var i = 0; i < config.polyfills.length; i++) {
                var decodedPoints = google.maps.geometry.encoding.decodePath(config.polyfills[i]);

                var encodedPolyline = new google.maps.Polyline({
                    strokeColor: "#ff0000",
                    strokeOpacity: 0.67,
                    strokeWeight: 3,
                    path: decodedPoints,
                    clickable: false
                });

                encodedPolyline.setMap(config.map);
            }
        }

        /**
         * Plot map canvas
         */
        function setupCanvas() {
            var mapOptions = {
                mapTypeId: google.maps.MapTypeId.MAP
            };

            var map = new google.maps.Map(document.getElementById(config.element.attr('id')), mapOptions);
            map.fitBounds(getBounds());

            config.map = map;
        }
    }
})(jQuery);