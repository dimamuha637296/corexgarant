!function () {
    'use strict';

    function popupGallery () {
        var gallery = $('.popup-gallery');
        if (!gallery.length) {
            return false;
        }
        var galleryLinks = gallery.find('.slick-slide:not(.slick-cloned) .inner');
        galleryLinks.magnificPopup({
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                tCounter: '<span class="mfp-counter">%curr% / %total%</span>',
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function () {
                    return false;
                }
            },
            zoom: {
                enabled: true,
                duration: 300, // don't foget to change the duration also in CSS
                opener: function(element) {
                    return element.find('img');
                }
            }
        });
    }

    //https://github.com/kenwheeler/slick/
    function initSlider() {
        var block = $('.sl-prod');
        if (!block.length && !$.fn.slick) {
            return false;
        }
        var slider = block.find('.slider');
        //var slidesLength = slider.find('.slide').length;
        var sliderWrap = block.find('.wrap');
        sliderWrap.removeClass('inited-not');
        slider.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveHeight: false, // true - height: auto
            autoplay: false,
            autoplaySpeed: 7000,
            speed: 500,
            arrows: false,
            dots: false,
            dotsClass: 'list-reset', // pager class
            asNavFor: '.sl-prod-nav .slider'
        });
        sliderWrap.addClass('inited');
    }

    $(function () {
        initSlider();
        popupGallery();
    });
}();