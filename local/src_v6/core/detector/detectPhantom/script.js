!function () {
    'use strict';

    /**
     * Детектим включение страницы на PhantomJS
     * Добавляем клаас для body
     */
    function detectPhantom() {
        var phantom = /phantom/i.test(navigator.userAgent);
        if (phantom) {
            $('html').addClass('phantom');
        }
    }

    // Call functions
    $(function () {
        detectPhantom();
    });
}();