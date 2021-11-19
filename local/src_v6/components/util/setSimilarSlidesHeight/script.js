/**
 * Установка одинаковую высоту для слайдов
 * @param {jQuery} slider - объект слайдера
 */
/* eslint-disable-next-line no-unused-vars */
function setSimilarSlidesHeight(slider) {
    'use strict';
    var slides = slider.find('.slide');
    if (slides.length > 0) {
        var maxHeight = 0;
        slides.each(function () {
            var slide = $(this);
            slide.css('height', '');
            var slideHeight = slide.outerHeight();
            if (maxHeight < slideHeight) {
                maxHeight = slideHeight;
            }
        });
        slides.css('height', maxHeight);
    }
}