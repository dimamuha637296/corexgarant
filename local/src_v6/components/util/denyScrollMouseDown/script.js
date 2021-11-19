!function () {
    'use strict';

    var oWindow = $(window);
    var denyScrollMouseDown = {

        init: function () {
            var overBlock1 = $('[class ^= full-bg-]');
            if (overBlock1.length) {
                oWindow.on('mousedown', function(e) {
                    if (e.which === 2) {
                        e.preventDefault();
                    }
                });
            }
        }
    };

    oWindow.on('load', function () {
        denyScrollMouseDown.init();
    });
}();