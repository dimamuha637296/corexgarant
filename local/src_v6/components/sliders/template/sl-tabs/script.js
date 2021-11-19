!function () {
    'use strict';

    var slTabs = {

        destroySliders: function () {
            var sliders = this.block.find('.slider');
            sliders.slick('destroy');
        },

        reInitSlider: function () {
            var activeTab = this.block.find('.tab-pane.active');
            var sliderWrap = activeTab.find('.wrap');
            this.initSlider(sliderWrap);
        },

        setHandlers: function () {
            this.tabLink = this.block.find('.nav-link');
            this.tabLink.off('shown.bs.tab').on('shown.bs.tab', function () {
                slTabs.destroySliders();
                slTabs.reInitSlider();
                console.log('yep');
            });
        },

        initSlider: function (wrap) {
            var sliderWrap = wrap;
            var slider = sliderWrap.find('.slider');
            var slidesLength = slider.find('.slide').length;
            var pager = sliderWrap.find('.js-sl-pager');
            var prev = sliderWrap.find('.prev');
            var next = sliderWrap.find('.next');
            sliderWrap.removeClass('inited-not');
            slider.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                adaptiveHeight: false, // true - height: auto
                autoplay: true,
                autoplaySpeed: 7000,
                speed: 500,
                arrows: slidesLength > 1,
                dots: slidesLength > 1,
                appendDots: pager,
                dotsClass: 'list-reset', // pager class
                nextArrow: next,
                prevArrow: prev
            });
            sliderWrap.addClass('inited');
        },

        init: function () {
            this.block = $('.sl-tabs');
            if (!this.block.length && !$.fn.slick) {
                return false;
            }
            this.sliderWrap = this.block.find('.wrap');
            this.sliderWrap.each(function () {
                slTabs.initSlider($(this));
            });
            this.setHandlers();
        }
    };

    $(function () {
        slTabs.init();
    });
}();