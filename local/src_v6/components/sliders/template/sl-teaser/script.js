!function () {
    'use strict';
    var $window = $(window);
    
    function initSliderPartners() {
        var sliderPartners = $('.sl-teaser');
        if (sliderPartners.length && $.fn.carouFredSel) {
            var slider = sliderPartners.find('.slider');
            var prev = sliderPartners.find('.prev');
            var next = sliderPartners.find('.next');
            slider.carouFredSel({
                width: '100%',
                height: 'auto',
                prev: prev,
                next: next,
                auto: false,
                scroll: {
                    duration: 200,
                    timeoutDuration: 7000,
                    pauseOnHover: true
                }
            });
            slideSwiper.init(slider);
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