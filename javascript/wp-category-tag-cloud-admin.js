/**
 * Wrapper function to safely use $
 */
function wpctcAdminWrapper($) {
    var wpctcAdmin = {

        /**
         * Main entry point
         */
        init: function () {
            $('.cloud-type-selector').change(wpctcAdmin.hideshow);
            $('.cloud-type-selector').each(wpctcAdmin.hideshow);
        },
        hideshow: function () {
              if ($(this).val() == 'array') {
                  $(this).parent().parent().find('.cloud-non-price').show();
                  $(this).parent().parent().find('.canvas-config').show();
              }
              else if ($(this).val() == 'price') {
                  $(this).parent().parent().find('.canvas-config').hide();
                  $(this).parent().parent().find('.cloud-non-price').hide();
              }
              else {
                  $(this).parent().parent().find('.cloud-non-price').show();
                  $(this).parent().parent().find('.canvas-config').hide();
              }
        }
    }; // end wpctcAdmin

    $(document).ready(wpctcAdmin.init);

} // end wpctcAdminWrapper()

wpctcAdminWrapper(jQuery);
