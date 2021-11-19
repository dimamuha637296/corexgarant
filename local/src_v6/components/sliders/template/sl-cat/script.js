!function () {
    'use strict';

    function setActiveLink(links) {
        var active = links.find('.active');
        if (!active.length) {
            links.first().addClass('active');
        }
    }

    function switchLink(slideIndex, links) {
        var next = links.eq(slideIndex);
        links.removeClass('active');
        if (next.length) {
            next.addClass('active');
        } else {
            links.eq(0).addClass('active');
        }
    }

    //https://github.com/kenwheeler/slick/
    function initSlider() {
        var block = $('.sl-cat');
        if (!block.length || !$.fn.slick) {
            return false;
        }
        var slider = block.find('.slider');
        var slidesLength = slider.find('.slide').length;
        var sliderWrap = block.find('.wrap');
        var next = block.find('.next');
        var links = block.find('.sl-cat-links .link');
        sliderWrap.removeClass('inited-not');
        slider.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveHeight: false, // true - height: autos
            autoplay: true,
            autoplaySpeed: 7000,
            speed: 500,
            arrows: slidesLength > 1,
            nextArrow: next,
            prevArrow: null
        });
        sliderWrap.addClass('inited');
        /* eslint-disable-next-line no-unused-vars */
        slider.on('beforeChange', function (event, slick, currentSlideIndex, nextSlideIndex) {
            if (currentSlideIndex !== nextSlideIndex) {
                switchLink(nextSlideIndex, links);
            }
        });
        setActiveLink(links);
    }

    $(function () {
        initSlider();
    });
}();