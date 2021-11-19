!function () {
    'use strict';

    var slMain3 = {

        setLinkHandlers: function () {
            this.links.each(function (i) {
                var self = $(this);
                self.on('click.slMain3', function (e) {
                    e.preventDefault();
                    slMain3.slider.slick('slickGoTo', i);
                    slMain3.switchLink(i);
                });
            });
        },

        setActiveLink: function () {
            var active = this.links.find('.active');
            if (!active.length) {
                this.links.first().addClass('active');
            }
        },

        switchLink: function(slideIndex) {
            var next = this.links.eq(slideIndex);
            this.links.removeClass('active');
            if (next.length) {
                next.addClass('active');
            } else {
                this.links.eq(0).addClass('active');
            }
        },

        init: function () {
            this.block = $('.sl-main-3');
            if (!this.block.length || !$.fn.slick) {
                return false;
            }
            this.slider = this.block.find('.slider');
            this.pager = this.block.find('.js-sl-pager');
            this.slides = this.slider.find('.slide');
            this.slidesLength = this.slides.length;
            this.sliderWrap = this.block.find('.wrap');
            this.sliderWrap.removeClass('inited-not');
            this.linksWrap = this.block.find('.links');
            this.links = this.linksWrap.find('.link');
            this.slides.first().addClass('current');
            this.slider.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                adaptiveHeight: false, // true - height: autos
                autoplay: false,
                autoplaySpeed: 5000,
                speed: 500,
                arrows: false,
                dots: this.slidesLength > 1,
                appendDots: this.pager,
                dotsClass: 'list-reset'
            });
            this.sliderWrap.addClass('inited');
            /* eslint-disable-next-line no-unused-vars */
            this.slider.on('beforeChange', function (event, slick, currentSlideIndex, nextSlideIndex) {
                if (currentSlideIndex !== nextSlideIndex) {
                    slMain3.switchLink(nextSlideIndex);
                }
            });
            /* eslint-disable-next-line no-unused-vars */
            this.slider.on('afterChange', function (event, slick, currentSlideIndex) {
                var currentSlide = $(slMain3.slides[currentSlideIndex]);
                slMain3.slider.find('.current').removeClass('current');
                currentSlide.addClass('current');
            });
            this.setActiveLink();
            this.setLinkHandlers();
        }
    };

    $(function () {
        slMain3.init();
    });
}();