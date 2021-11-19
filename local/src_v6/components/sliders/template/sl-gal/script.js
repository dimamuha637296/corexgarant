!function () {
    'use strict';

    //https://github.com/kenwheeler/slick/
    function initSlider() {
        var block = $('.sl-gal');
        if (!block.length || !$.fn.slick) {
            return false;
        }
        var slider = block.find('.slider');
        var slidesLength = slider.find('.slide').length;
        var sliderWrap = block.find('.wrap');
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
            nextArrow: next,
            prevArrow: prev
        });
        sliderWrap.addClass('inited');
    }

    $(function () {
        initSlider();
    });
}();