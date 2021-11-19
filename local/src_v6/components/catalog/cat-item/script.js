!function () {
    'use strict';
    var $window = $(window);

    function setHiddenInfoState(state, block, margin) {
        if (state === true) {
            block.addClass('active');
        } else {
            block.removeClass('active');
        }
        block.css({'margin-bottom': -margin});
        block.css({'padding-bottom': margin});
    }

    function initCatItem() {
        var block = $('.cat-item');

        if (!block.length) {
            return false;
        }
        block.each(function () {
            var self = $(this);
            var hiddenInfo = self.find('.mid-info');

            if (hiddenInfo.length) {
                hiddenInfo.css({'height': 'auto'});
                var hiddenInfoHeight = hiddenInfo.outerHeight();
                if (getInnerWidth() < ws.const.screen.grid_breakpoint_max) {
                    setHiddenInfoState(true, self, hiddenInfo, hiddenInfoHeight, 0);
                    self.off('mouseenter.catitem mouseleave.catitem');
                } else {
                    self.removeClass('active');
                    self.css({'margin-bottom': 0});
                    self.css({'padding-bottom': 0});
                    self.on('mouseenter.catitem', function () {
                        setHiddenInfoState(true, self, hiddenInfoHeight);
                    });
                    self.on('mouseleave.catitem', function () {
                        setHiddenInfoState(false, self, 0);
                    });
                }
            }
        });
    }

    $(function () {
        initCatItem();
        listAutoHeight();
    });

    $window.on('load', function () {
        initCatItem();
    });

    $window.on('resize', function () {
        initCatItem();
        listAutoHeight();
    });
}();