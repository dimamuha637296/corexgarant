!function () {
    'use strict';

    var oWindow = $(window);

    function setMainPadding() {
        var header = $('.header');
        var main = $('.g-main');
        if (!header.length) {
            return false;
        }
        var position = header.css('position');
        var headerHeight = header.outerHeight();
        if (position === 'fixed') {
            main.css({
                'padding-top': headerHeight
            });
        } else {
            main.css({
                'padding-top': ''
            });
        }
    }

    $(function () {
        setMainPadding();
    });

    oWindow.on('load', function () {
        setMainPadding();
    });

    oWindow.on('resize', function () {
        setMainPadding();
    });
}();
