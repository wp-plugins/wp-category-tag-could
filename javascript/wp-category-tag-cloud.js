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

            $('.wpctc-tilt a').each(function () {
                var $deg = Math.floor((Math.random() * 90) - 45);
                $(this).css({transform: 'rotate(' + $deg + 'deg)'});
            });
            $('.wpctc-colorize a').each(function () {
                var $letters = '0123456789ABCDEF'.split('');
                var $color = '#';
                for (var i = 0; i < 6; i++) {
                    $color += $letters[Math.floor(Math.random() * 16)];
                }
                $(this).style('color', $color, 'important');
            });
        }
    }; // end wpctc

    $(document).ready(wpctc.init);

} // end wpctcWrapper()

wpctcWrapper(jQuery);
