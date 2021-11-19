!function () {
    'use strict';

    // Одновременное наведение на 2 разных ссылки
    var autoHover = {

        init: function () {
            var list = $('.js-hover');
            if (!list.length) {
                return false;
            }
            list.each(function () {
                var listSelf = $(this);
                var wrap = listSelf.find('.js-hover-wrap');
                if (wrap.length) {
                    wrap.each(function () {
                        var wrapSelf = $(this);
                        var items = wrapSelf.find('.js-hover-trg');
                        if (items.length > 1) {
                            items.on('mouseenter', function () {
                                items.addClass('hover');
                            });
                            items.on('mouseleave', function () {
                                items.removeClass('hover');
                            });
                        }
                    });
                }
            });
        }
    };

    $(window).on('load', function () {
        autoHover.init();
    });
}();