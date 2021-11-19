!function () {
    'use strict';
    var $window = $(window);

    function initSlider() {
        var sliderWrap = $('.sl-main-4');
        var wrap = sliderWrap.find('.wrap');
        var slider = wrap.find('.slider');
        if (slider.length && $.fn.carouFredSel) {
            var windowWidth = getInnerWidth();
            var w_small = 0.15;
            var w_big = 0.85;
            var _sizes = function() {
                if (windowWidth >= ws.const.screen.screen_xl_min) {
                    w_small = 0.07;
                    w_big = 0.65;
                } else if (windowWidth >= ws.const.screen.screen_md_min) {
                    w_small = 0.15;
                    w_big = 0.7;
                } else if (windowWidth >= ws.const.screen.screen_sm_min) {
                    w_small = 0.3;
                    w_big = 0.7;
                }
            };
            _sizes();
            var _width = wrap.width();
            var slide = slider.find('.slide');
            var firstSlide = slide.first();
            fullWrap.init(sliderWrap);
            wrap.removeClass('not-init');
            slider.carouFredSel({
                width: '100%',
                align: false,
                items: {
                    width: wrap.width() * w_small,
                    height: 400,
                    visible: 1,
                    minimum: 1
                },
                auto: 10000,
                scroll: {
                    items: 1,
                    timeoutDuration: 5000,
                    pauseOnHover: true,
                    onBefore: function(data) {
                        // find current and next slide
                        var slide = slider.find('.slide:not(.active)');
                        var _width = wrap.width();

                        slide.width(_width * w_small);

                        var slideWidth = slide.width();
                        var currentSlide = slider.find('.slide.active');
                        var nextSlide = data.items.visible;

                        // resize current slide to small version
                        currentSlide.stop().animate({
                            width: _width * w_small
                        });
                        currentSlide.removeClass('active');

                        // hide current block
                        data.items.old.add(data.items.visible).find('.slide-block').stop().fadeOut();

                        // animate clicked slide to large size
                        nextSlide.addClass('active');
                        if (windowWidth >= ws.const.screen.screen_md) {
                            nextSlide.stop().animate({
                                width: _width * w_big - slideWidth
                            });
                        } else {
                            nextSlide.stop().animate({
                                width: _width * w_big
                            });
                        }

                    },
                    onAfter: function(data) {
                        var slide = data.items.visible.last();
                        var block = slide.find('.slide-block');
                        var width = slide.innerWidth();

                        if (window.innerWidth < ws.const.screen.screen_md) {
                            block.css('width', width);
                        } else {
                            block.css('width', '');
                        }

                        // show active slide block
                        block.stop().fadeIn();
                    }
                },
                onCreate: function() {
                    //clone images for better sliding and insert them dynamacly in slider
                    var newitems = slide.clone(true);
                    $(this).trigger('insertItem', [newitems, newitems.length, false]);
                    slide = slider.find('.slide:not(.active)');
                    firstSlide = slide.first();

                    // show images
                    slide.fadeIn();
                    firstSlide.addClass('active');
                    slide.width(_width * w_small);
                    var slideWidth = slide.width();

                    // enlarge first slide
                    if (windowWidth >= ws.const.screen.screen_md) {
                        firstSlide.animate({
                            width: _width * w_big - slideWidth
                        });
                    } else {
                        firstSlide.animate({
                            width: _width * w_big
                        });
                    }

                    // show first title block and hide the rest
                    slider.find('.slide-block').hide();
                    slider.find('.slide.active .slide-block').stop().fadeIn();
                }
            });

            // Handle click events
            slider.children().click(function() {
                slider.trigger('slideTo', [this]);
            });

            $window.on('resize.slider', function () {
                slide = slider.find('.slide');
                slide.width(_width * w_small);
                windowWidth = window.innerWidth;
                _sizes();

                _width = wrap.width();

                firstSlide = slide.first();

                // Открываем на 320пикс, нажимаем следующий слайд, ресайзим до десктопа. На след слайде все ок становится
                slide.find('.slide-block').css('width', '');

                // show images
                var slideWidth = slide.width();

                // enlarge first slide
                if (windowWidth >= ws.const.screen.screen_md) {
                    slider.find('.slide.active').width(_width * w_big - slideWidth);
                } else {
                    slider.find('.slide.active').width(_width * w_big);
                }

                // update item width config
                slider.trigger('configuration', ['items.width', _width * w_small]);
            });
        }
    }

    // Вызываем только на DOMReady, потому что остальные обработчики навешиваются при инициализации слайдера
    $(function () {
        initSlider();
    });
}();