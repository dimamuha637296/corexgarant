!function () {
    'use strict';

    function parallax(item) {
        var distanceFromTop = item[0].getBoundingClientRect().top;
        var height = item.outerHeight();
        var ratio = ((distanceFromTop + height / 2) / getInnerHeight()) * 100 - 50;
        ratio *= 2;
        if (ratio > 210) {
            ratio = 210;
        }
        if (ratio < -210) {
            ratio = -210;
        }
        item.css('transform', 'translateY(' + ratio + 'px)');
    }

    function initParallax() {
        var items = $('.parallax');
        if (!items.length || getInnerWidth() < ws.const.screen.screen_lg_max) {
            return false;
        }
        var itemsArr = [];
        items.each(function () {
            itemsArr.push($(this));
        });
        $(window).on('scroll', function () {
            itemsArr.forEach(function (item) {
                parallax(item);
            });
        });
    }

    $(function () {
        initParallax();
    });
}();