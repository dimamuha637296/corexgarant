!function () {
    'use strict';

    //https://github.com/kenwheeler/slick/
    function initSlider() {
        var block = $('.sl-main');
        if (!block.length) {
            return false;
        }
        var slider = block.find('.slider');
        var slidesLength = slider.find('.slide').length;
        var pager = block.find('.js-sl-pager');
        var sliderWrap = block.find('.wrap');
        var prev = block.find('.prev');
        var next = block.find('.next');
        sliderWrap.removeClass('inited-not');
        slider.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveHeight: false, // true - height: auto
            autoplay: false,
            autoplaySpeed: 7000,
            speed: 500,
            arrows: slidesLength > 1,
            dots: slidesLength > 1,
            appendDots: pager,
            dotsClass: 'list-reset', // pager class
            nextArrow: next,
            prevArrow: prev,
            responsive: [
                {
                    breakpoint: ws.const.screen.screen_xs_max,
                    settings: {
                        arrows: false
                    }
                }
            ]
        });
        sliderWrap.addClass('inited');
    }

    $(function () {
        initSlider();
    });
}();