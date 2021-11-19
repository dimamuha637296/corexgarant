/* eslint-disable-next-line no-unused-vars */
function slideCounter(sliderBlock) {
    'use strict';
    var slider = sliderBlock.find('.slider');
    var currentSlideWrap = sliderBlock.find('.current-slide');
    var slidesCountWrap = sliderBlock.find('.slides-count');
    /* eslint-disable-next-line no-unused-vars */
    slider.on('init', function (e, a) {
        currentSlideWrap.text(a.currentSlide + 1);
        slidesCountWrap.text(a.$slides.length);
    });
    /* eslint-disable-next-line no-unused-vars */
    slider.on('afterChange', function (e, a) {
        currentSlideWrap.text(a.currentSlide + 1);
    });
}
