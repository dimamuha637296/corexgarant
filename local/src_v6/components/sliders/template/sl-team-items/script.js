!function () {
    'use strict';

    function setSlidesHeight(slider) {
        if (typeof setSimilarSlidesHeight === 'function') {
            setSimilarSlidesHeight(slider);
        }
    }

    //https://github.com/kenwheeler/slick/
    function initSlider() {
        var block = $('.sl-team-items');
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
            sliderWrap.removeClass('inited-not');
            slideCounter(block);
            slider.on('setPosition', function () {
                setSlidesHeight(slider);
            });
            slider.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                adaptiveHeight: false, // true - height: auto
                autoplay: false,
                autoplaySpeed: 7000,
                speed: 500,
                // centerMode: true,
                arrows: false,
                dots: slidesLength > 3,
                appendDots: pager,
                dotsClass: 'list-reset', // pager class
                nextArrow: next,
                prevArrow: prev,
                responsive: [
                    {
                        breakpoint: ws.const.screen.screen_lg_max,
                        settings: {
                            slidesToShow: 3,
                            // arrows: slidesLength > 3,
                            dots: slidesLength > 3
                        }
                    },
                    {
                        breakpoint: ws.const.screen.screen_sm_max,
                        settings: {
                            slidesToShow: 2,
                            // arrows: slidesLength > 2,
                            dots: slidesLength > 2
                        }
                    },
                    {
                        breakpoint: ws.const.screen.screen_xs_max,
                        settings: {
                            slidesToShow: 1,
                            // arrows: false,
                            dots: slidesLength > 1,
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