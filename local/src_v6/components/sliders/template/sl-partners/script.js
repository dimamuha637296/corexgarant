!function () {
    'use strict';
    var $window = $(window);

    function initSliderPartners() {
        var sliderPartners = $('.sl-partners');
        if (sliderPartners.length && $.fn.carouFredSel) {
            sliderPartners.each(function () {
                var self = $(this);
                var slider = self.find('.slider');
                var prev = self.find('.prev');
                var next = self.find('.next');
                var wrap = self.find('.wrap');
                wrap.removeClass('inited-not');
                slider.carouFredSel({
                    width: '100%',
                    height: 'auto',
                    prev: prev,
                    next: next,
                    auto: false,
                    scroll: {
                        duration: 200,
                        items: 1,
                        timeoutDuration: 7000,
                        pauseOnHover: true
                    }
                });
                wrap.addClass('inited');
                slideSwiper.init(slider);
            });
        }
    }

    // Call functions
    $(function () {
        initSliderPartners();
    });
    $window.on('load', function () {
        initSliderPartners();
    });
    $window.on('resize', function () {
        initSliderPartners();
    });
}();