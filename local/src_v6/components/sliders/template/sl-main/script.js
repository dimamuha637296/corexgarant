!function () {
    'use strict';

    /* eslint-disable-next-line no-unused-vars */
    function slideCounter(sliderBlock) {
        var slider = sliderBlock.find('.slider');
        var currentSlideWrap = sliderBlock.find('.current-slide');
        /* eslint-disable-next-line no-unused-vars */
        slider.on('init', function (e, a) {
            var num = a.currentSlide + 1;
            if (num < 10) {
                num = '0' + num;
            }
            currentSlideWrap.text(num);
        });
        /* eslint-disable-next-line no-unused-vars */
        slider.on('afterChange', function (e, a) {
            var num = a.currentSlide + 1;
            if (num < 10) {
                num = '0' + num;
            }
            currentSlideWrap.text(num);
        });
    }

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
            slideCounter(block);
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
                // responsive: [
                //     {
                //         breakpoint: ws.const.screen.screen_xs_max,
                //         settings: {
                //             arrows: false
                //         }
                //     }
                // ]
            });
            sliderWrap.addClass('inited');
        });
    }

    $(function () {
        initSlider();
    });
}();