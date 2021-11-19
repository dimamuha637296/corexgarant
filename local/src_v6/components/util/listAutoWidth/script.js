// Automatic width for elements in column
/* eslint-disable-next-line no-unused-vars */
function listAutoWidth() {
    'use strict';

    var list = $('.js-width');
    if (list.length) {
        list.each(function () {
            var oThis;
            var trg;
            var maxW;
            var iThis;
            var thisW;

            oThis = $(this);
            trg = oThis.find('.js-width-trg');
            maxW = 0;
            trg.each(function () {
                iThis = $(this);
                // Скидываем минимальную высоту для всех элементов
                iThis.css({
                    'width': ''
                });
                // Узнаем максимальную ширину картинки в столбце
                thisW = iThis.outerWidth();
                if (maxW < thisW) {
                    maxW = thisW;
                }
            });
            // Расставляем минимальную ширину всему блоку
            trg.each(function () {
                $(this).css({
                    'width': maxW
                });
            });
        });
    }
}

!function () {
    'use strict';

    var oWindow = $(window);

    $(function () {
        listAutoWidth();
    });

    oWindow.on('load', function () {
        listAutoWidth();
    });

    oWindow.on('resize', function () {
        listAutoWidth();
    });
}();