!function () {
    'use strict';

    function setHandlers(block) {
        block.each(function () {
            var self = $(this);
            self.off('mousedown').on('mousedown', function () {
                self.addClass('cursor-active');
            });
            self.off('mouseup').on('mouseup', function () {
                self.removeClass('cursor-active');
            });
        });
    }

    function findCursor() {
        var block = $('.cursor');
        if (!block.length || !($('html').hasClass('ie'))) {
            return false;
        }
        setHandlers(block);
    }

    $(function () {
        findCursor();
    });
}();