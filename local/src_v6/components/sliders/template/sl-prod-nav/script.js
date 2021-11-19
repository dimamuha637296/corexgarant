!function () {
    'use strict';

    //https://github.com/kenwheeler/slick/
    function initSlider() {
        var block = $('.sl-prod-nav');
        if (!block.length && !$.fn.slick) {
            return false;
        }
        var slider = block.find('.slider');
        var prev = block.find('.prev');
        var next = block.find('.next');
        var slidesLength = slider.find('.slide').length;
        var sliderWrap = block.find('.wrap');
        sliderWrap.removeClass('inited-not');
        if (slidesLength <= 3) {
            sliderWrap.addClass('not-move');
        }
        slider.slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            adaptiveHeight: false, // true - height: auto
            // variableWidth: true,
            autoplay: false,
            autoplaySpeed: 7000,
            speed: 500,
            arrows: slidesLength > 3,
            dots: false,
            focusOnSelect: true,
            dotsClass: 'list-reset', // pager class
            asNavFor: '.sl-prod .slider',
            nextArrow: next,
            prevArrow: prev,
            responsive: [
                {
                    breakpoint: ws.const.screen.screen_lg,
                    settings: {
                        slidesToShow: 2,
                        arrows: slidesLength > 2
                    }
                },
                {
                    breakpoint: ws.const.screen.screen_md,
                    settings: {
                        slidesToShow: 3,
                        arrows: slidesLength > 3
                    }
                },
                {
                    breakpoint: ws.const.screen.screen_mob,
                    settings: {
                        variableWidth: false
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