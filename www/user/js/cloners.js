/**
 * cloners.js
 *
 * Add ability to clone elements in a form.
 * This allows multiple copies of a particular form element.
 *
 * An activator with the attribute data-cloner="true" will, upon click,
 * cause another element with the attribute data-cloneable="true" to be
 * cloned and appended to the nearest fieldset
 *
 * Date: 25/05/2014
 * Time: 1:57 PM
 */
(function($) {

    /**
     * Apply cloneable form elements
     */
    $.fn.addCloners = function(options) {

        /* Accept optional parameter
         */
        options = options || {};

        var config = init($(this), options);

        /* Send in the clones
         */
        activateCloners();
        activateDecloners();

        /**
         * Init
         */
        function init(element, options) {
            var defaults =  {
                element: element
            }

            var derived = {
            }

            var merged = $.extend(defaults, derived, options);

            return merged;
        }

        /**
         * Activate cloner elements
         */
        function activateCloners() {
            $(config.element).find('[data-cloner="true"]').click(function() {
                var fieldset = $(this).closest('fieldset');
                var element = fieldset.find('[data-cloneable="true"]').clone();

                /* Enable input elements
                 * Remove data attributes
                 * Remove classes
                 */
                element.find('input, select, textarea').prop('disabled', false);
                element.removeAttr('data-cloneable');
                element.removeClass('hidden');

                /* Inject into DOM
                 */
                fieldset.find('[data-cloneable-socket="true"]').append(element);
            })
        }

        /**
         * Remove a clone
         */
        function activateDecloners() {
            $(document).on('click', '[data-cloner-remover="true"]', function() {
                $(this).closest('section').remove();
            })
        }
    }
})(jQuery);