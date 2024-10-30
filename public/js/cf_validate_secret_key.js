/*
 * Copyright 2016 CurrencyFair - www.currencyfair.com
 * JS File - Wordpress Plugin v1.0.0
 * Author: CurrencyFair
*/

jQuery(document).ready(function() {

    var notice_visible = false,
        settings = jQuery('#currencyfair-main');

    settings.on('submit', 'form', testSecret);

    function testSecret(e) {
        var data = {
            action: 'currencyfair_validate_secret_key',
            secret_key: settings.find('input[name="currencyfair_account_secret_key"]').val()
        }

        jQuery.post(param.ajaxUrl, data, function(data) {

            var status = jQuery(data).find('response_data').text(),
                message = jQuery(data).find('supplemental message').text();

            if (status == 'updated') {
                show_message(message, status);
                settings.find('form')[0].submit();
            } else {
                show_message(message, status);
            }

        }).fail(function() {
            show_message(param.genericErrorMsg, 'error');
        });

        e.preventDefault();
    }

    function show_message(message, type) {
        if (notice_visible) {
            return false;
        }
        notice_visible = true

        var notice = settings.find('.notice');

        notice.show().append(jQuery('<p/>', {text : message})).addClass(type);

        setTimeout(function() {
            notice.fadeOut('slow', function() {
                jQuery(this).removeClass('error updated update-nag').empty();
                notice_visible = false;
            });
        }, 3000);
    }

});
