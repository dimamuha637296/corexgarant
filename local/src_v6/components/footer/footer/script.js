!function () {
    'use strict';

    var oWindow = $(window);

    function footerDown() {
        var main = $('.g-main');
        if (main.length) {
            var minH = oWindow.outerHeight() - 1;
            var header = $('.header');
            if (header.length && header.css('position') !== 'fixed') {
                minH -= header.outerHeight();
            }
            var footer = $('.footer');
            if (footer.length) {
                minH -= footer.outerHeight();
            }
            main.css({
                'min-height': minH
            });
        }
    }

    $(function () {
        footerDown();
    });

    oWindow.on('load', function () {
        footerDown();
    });

    oWindow.on('resize', function () {
        footerDown();
    });
}();