!function () {
    'use strict';

    var scrollTo = {

        scroll: function (target) {
            var top = target.offset().top;
            if (getInnerWidth() <= ws.const.screen.grid_breakpoint_max) {
                var header = $('.header');
                top -= header.outerHeight();
            }
            $('html, body').stop().animate({
                scrollTop: top
            }, 1000);
        },

        setHandlers: function() {
            this.block.each(function () {
                var self = $(this);
                var href = self.attr('href');
                var sharpIndex = href.indexOf('#');

                if (href.indexOf('//') === -1 && sharpIndex > -1) {
                    var target = $(href.slice(sharpIndex));
                    if (target.length > 0) {
                        self.off('click.scrollTo').on('click.scrollTo', function (e) {
                            e.preventDefault();
                            scrollTo.scroll(target);
                        });
                    }
                }
            });
        },

        init: function () {
            this.block = $('.js-scroll-to');
            if (!this.block.length) {
                return false;
            }
            this.setHandlers();
        }
    };

    $(function () {
        scrollTo.init();
    });
}();