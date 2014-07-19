/**
 * Wrapper function to safely use $
 */
function wpctcWrapper($) {
    var wpctc = {

        /**
         * Main entry point
         */
        init: function () {
            $('.wpctc-opacity').each(function () {
                var opaque_a = $(this).find('a');
                $(opaque_a.get().reverse()).each(function (i) {
                    $(this).css({ opacity: (i + 1) * 2 / 3 / opaque_a.length + 1 / 3 });
                });
            });
        }
    }; // end wpctc

    $(document).ready(wpctc.init);

} // end wpctcWrapper()

wpctcWrapper(jQuery);
