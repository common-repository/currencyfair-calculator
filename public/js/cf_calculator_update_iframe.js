jQuery(document).ready(function() {

    var cfwidget = {
        url : param.iframeUrl,
        ext : 'html'
    };

    jQuery('#update_iframe').on('change', 'form', updateIframe);

    function updateIframe(e) {
        var form = jQuery(this),
            widget_size = form.find('#widget_size').val(),
            iframe = jQuery('.iframe_container iframe'),
            result = widget_size.split('x');

        iframe.attr('src', cfwidget.url + widget_size + '.' + cfwidget.ext + '?token=' + param.accessToken);
        iframe.attr('width', result[0]);
        iframe.attr('height', result[1]);

        e.preventDefault();
    }

});
