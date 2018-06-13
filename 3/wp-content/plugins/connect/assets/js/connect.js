jQuery('document').ready(function () {

    jQuery('body').on('submit', '#form-connect', function (e) {
        e.preventDefault();

        jQuery.post(ajax_object.ajax_url, jQuery(this).serialize(), function (html) {
            jQuery('#connect-return').html(html);
        });
    });

});