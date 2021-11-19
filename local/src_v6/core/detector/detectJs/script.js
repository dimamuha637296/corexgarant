!function () {
    'use strict';

    // Check working JS
    function js_on() {
        var oJs = $('.js-off');
        if (oJs.length) {
            oJs.removeClass('js-off').addClass('js-on');
        }
    }

    // Call functions
    $(function () {
        js_on();
    });
}();