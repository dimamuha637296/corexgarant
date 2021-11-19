/* eslint-disable-next-line no-unused-vars */
var slideSwiper = {

    /**
     * Свайп на ссылках внутри слайдера carouFredSel
     * @param {object} slider объект на котором заинитили слайдер
     * @param {function} func необязательная callback-функция
     */
    init: function(slider, func) {
        'use strict';

        slider.find('a').off('click.preventer').on('click.preventer', function(e) {
            e.preventDefault();
        });
        slider.swipe({
            onMouse: true,
            onTouch: true,
            excludedElements: 'input, select, textarea, .noSwipe',
            swipeLeft: function() {
                slider.trigger('next');
            },
            swipeRight: function() {
                slider.trigger('prev');
            },
            /* eslint-disable-next-line no-unused-vars */
            tap: function(event, target) {
                var $target = $(target);
                if ($target.attr('href') === undefined) {
                    $target = $target.closest('a');
                }
                var link = $target.attr('href');
                if (link !== undefined) {
                    window.open(link, $target.attr('target') || '_self');
                }
                if (func !== undefined) {
                    func(target);
                }
            }
        });
    }
};