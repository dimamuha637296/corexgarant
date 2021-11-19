!function () {
    'use strict';

    //https://github.com/kenwheeler/slick/
    function initSlider() {
        var block = $('.sl-main');
        if (!block.length || !$.fn.slick) {
            return false;
        }
        block.each(function () {
            var self = $(this);
            var slider = self.find('.slider');
            var slidesLength = slider.find('.slide').length;
            var pager = self.find('.js-sl-pager');
            var sliderWrap = self.find('.wrap');
            var prev = self.find('.prev');
            var next = self.find('.next');
            fullWrap.init(self);
            sliderWrap.removeClass('inited-not');
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
                        breakpoint: ws.const.screen.screen_xs_max,
                        settings: {
                            arrows: false
                        }
                    }
                ]
            });
            sliderWrap.addClass('inited');
        });
    }

    $(function () {
        initSlider();
    });
}();