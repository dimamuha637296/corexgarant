/* eslint-disable-next-line no-unused-vars */
var mCustomScrollbar = {

    init: function(block, height) {
        'use strict';

        if (block.length && $.fn.mCustomScrollbar) {
            block.mCustomScrollbar({
                setHeight: height,
                theme: "dark-3"
            });
        }
    }
};