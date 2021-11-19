!function () {
    'use strict';

    //https://github.com/kenwheeler/slick/
    function initSlider() {
        var block = $('.sl-shares');
        if (!block.length && !$.fn.slick) {
            return false;
        }
        var slider = block.find('.slider');
        var slidesLength = slider.find('.slide').length;
        var sliderWrap = block.find('.wrap');
        var prev = block.find('.prev');
        var next = block.find('.next');
        sliderWrap.removeClass('inited-not');
        slider.slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            adaptiveHeight: false, // true - height: auto
            autoplay: true,
            autoplaySpeed: 7000,
            speed: 500,
            arrows: slidesLength > 2,
            nextArrow: next,
            prevArrow: prev,
            responsive: [
                {
                    breakpoint: ws.const.screen.screen_md_max,
                    settings: {
                        slidesToShow: 1,
                        arrows: slidesLength > 1
                    }
                }
            ]
        });
    }

    $(function () {
        initSlider();
    });
}();