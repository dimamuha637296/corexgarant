!function () {
    'use strict';
    var app = {

        init: function () {
            this.block = $('.test');
            if (!this.block.length) {
                return false;
            }
            console.log('inited');
        }
    };

    $(function () {
        app.init();
    });
}();