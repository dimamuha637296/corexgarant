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

    var scrollHeader = {
        init: function () {
            var header = $('.header__desktop');
            if (!header.length) {
                return false;
            }

            $(window).off('scroll.scrollHeader').on('scroll.scrollHeader', function() {
                var headerHeight = header.outerHeight();
                var headerPosition = header.offset().top;
                if (headerPosition > headerHeight) {
                    if (!header.hasClass('header__desktop--scroll')) {
                        // header.parent('.header').css('opacity', '0');
                        header.addClass('header__desktop--scroll');
                        // setTimeout(function() {
                        //     header.addClass('header__desktop--scroll');
                        //     setMainPadding();
                        //     header.parent('.header').css('opacity', '1');
                        // }, 250);
                    }
                    // setMainPadding();
                } else {
                    header.removeClass('header__desktop--scroll');
                    setMainPadding();
                }
            });
        }
    };

    $(function () {
        setMainPadding();
        scrollHeader.init();
    });

    oWindow.on('load', function () {
        setMainPadding();
    });

    oWindow.on('resize', function () {
        setMainPadding();
    });
}();
