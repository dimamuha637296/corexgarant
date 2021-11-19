!function () {
    'use strict';

    //https://github.com/kenwheeler/slick/
    function initSlider() {
        var block = $('.sl-prod-list');
        if (!block.length && !$.fn.slick) {
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
            sliderWrap.removeClass('inited-not');
            slider.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                adaptiveHeight: false, // true - height: auto
                autoplay: true,
                autoplaySpeed: 7000,
                speed: 500,
                arrows: slidesLength > 4,
                dots: slidesLength > 4,
                appendDots: pager,
                dotsClass: 'list-reset', // pager class
                nextArrow: next,
                prevArrow: prev,
                responsive: [
                    {
                        breakpoint: ws.const.screen.screen_lg_max,
                        settings: {
                            slidesToShow: 3,
                            arrows: slidesLength > 3,
                            dots: slidesLength > 3
                        }
                    },
                    {
                        breakpoint: ws.const.screen.screen_md_max,
                        settings: {
                            slidesToShow: 2,
                            arrows: slidesLength > 2,
                            dots: slidesLength > 2
                        }
                    },
                    {
                        breakpoint: 580,
                        settings: {
                            slidesToShow: 1,
                            arrows: slidesLength > 1,
                            dots: slidesLength > 1
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