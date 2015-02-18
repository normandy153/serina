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

		/* Plot markers
		 */
		plotMarkers();

        /**
         * Init
         */
        function init(element, options) {
            var defaults = {
                map: '',
                element: element,
                bounds: [],
                polyfills: [],
				markers: []
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
                var decodedPoints = google.maps.geometry.encoding.decodePath(base64_decode(config.polyfills[i]));

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
		 * Plot markers on map canvas
		 */
		function plotMarkers() {
			var image = '/event/img/marker.png';

			for (var i = 0; i < config.markers.length; i++) {
				if (config.markers[i].latitude != undefined) {
					var definition = {
						title: config.markers[i].description,
						icon: image,
						position: new google.maps.LatLng(config.markers[i].latitude, config.markers[i].longitude),
						map: config.map
					}

					var marker = new google.maps.Marker(definition);
				}
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

        function base64_decode(data) {
            //  discuss at: http://phpjs.org/functions/base64_decode/
            // original by: Tyler Akins (http://rumkin.com)
            // improved by: Thunder.m
            // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
            // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
            //    input by: Aman Gupta
            //    input by: Brett Zamir (http://brett-zamir.me)
            // bugfixed by: Onno Marsman
            // bugfixed by: Pellentesque Malesuada
            // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
            //   example 1: base64_decode('S2V2aW4gdmFuIFpvbm5ldmVsZA==');
            //   returns 1: 'Kevin van Zonneveld'
            //   example 2: base64_decode('YQ===');
            //   returns 2: 'a'
            //   example 3: base64_decode('4pyTIMOgIGxhIG1vZGU=');
            //   returns 3: '✓ à la mode'

            var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
            var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
                ac = 0,
                dec = '',
                tmp_arr = [];

            if (!data) {
                return data;
            }

            data += '';

            do {
                // unpack four hexets into three octets using index points in b64
                h1 = b64.indexOf(data.charAt(i++));
                h2 = b64.indexOf(data.charAt(i++));
                h3 = b64.indexOf(data.charAt(i++));
                h4 = b64.indexOf(data.charAt(i++));

                bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

                o1 = bits >> 16 & 0xff;
                o2 = bits >> 8 & 0xff;
                o3 = bits & 0xff;

                if (h3 == 64) {
                    tmp_arr[ac++] = String.fromCharCode(o1);
                } else if (h4 == 64) {
                    tmp_arr[ac++] = String.fromCharCode(o1, o2);
                } else {
                    tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
                }
            } while (i < data.length);

            dec = tmp_arr.join('');

            return decodeURIComponent(escape(dec.replace(/\0+$/, '')));
        }
    }
})(jQuery);