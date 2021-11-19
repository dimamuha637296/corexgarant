!function () {
    'use strict';

    function initScroll(slider) {
        var info = slider.find('.info');
        if (info.length && $.fn.mCustomScrollbar) {
            info.each(function () {
                $(this).mCustomScrollbar();
            });
        }
    }

    //https://github.com/kenwheeler/slick/
    function initSlider() {
        var block = $('.sl-project');
        if (!block.length && !$.fn.slick) {
            return false;
        }
        fullWrap.init(block);
        var slider = block.find('.slider');
        var slidesLength = slider.find('.slide').length;
        var sliderWrap = block.find('.wrap');
        var pager = block.find('.js-sl-pager');
        var prev = block.find('.prev');
        var next = block.find('.next');
        sliderWrap.removeClass('inited-not');
        slideCounter(block);
        slider.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveHeight: false, // true - height: auto
            autoplay: true,
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
                    breakpoint: ws.const.screen.screen_sm_max,
                    settings: {
                        arrows: false
                    }
                }
            ]
        });
        initScroll(slider);
    }

    $(function () {
        initSlider();
    });
}();