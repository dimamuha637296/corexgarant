!function () {
    'use strict';

    var slPager8 = {

        setTransitionDuration: function (slick, $pager) {
            var transitionDuration = slick.options.autoplaySpeed;
            var $pagerItem = $pager.find('li');
            var $pagerItemActive = $pagerItem.filter('.slick-active');
            $pager.css('transition-duration', transitionDuration + 'ms');
            $pagerItem.removeClass('active');
            setTimeout(function () {
                $pagerItemActive.addClass('active');
            }, 20);
        },

        // eslint-disable-next-line no-unused-vars
        bindSliderHandlers: function (slick, $slider, $pager) {
            var app = this;
            // eslint-disable-next-line no-unused-vars
            $slider.off('beforeChange.slPager8').on('beforeChange.slPager8', function (e, slick, currentSlideIndex, nextSlideIndex) {
                if (currentSlideIndex === nextSlideIndex) {
                    app.setTransitionDuration(slick, $pager);
                } else {
                    $slider.off('afterChange.slPager8').on('afterChange.slPager8', function () {
                        app.setTransitionDuration(slick, $pager);
                        $slider.off('afterChange.slPager8');
                    });
                }
            });
        },

        start: function (slick, $slider, $pager) {
            if (slick.options.autoplay === true) {
                $pager.addClass('animate');
                $slider.slick('setOption', 'pauseOnHover', false, true);
                $slider.slick('setOption', 'pauseOnFocus', false, true);
                this.setTransitionDuration(slick, $pager);
                this.bindSliderHandlers(slick, $slider, $pager);
            }
        },

        init: function () {
            var app = this;
            this.$block = $('.sl-pager-8');
            if (!this.$block.length) {
                return false;
            }
            this.$block.each(function () {
                var $pager = $(this);
                var $slider = $pager.siblings('.slider');
                var slick = $slider[0].slick;
                if (slick !== undefined) {
                    app.start(slick, $slider, $pager);
                } else {
                    // eslint-disable-next-line no-unused-vars
                    $slider.off('init.slPager8').on('init.slPager8', function (e, instance) {
                        slick = instance;
                        app.start(slick, $slider, $pager);
                    });
                }
            });
        }
    };

    $(function () {
        slPager8.init();
    });
}();