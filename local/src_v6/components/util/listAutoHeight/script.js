// Automatic height for elements in row
/* eslint-disable-next-line no-unused-vars */
function listAutoHeight() {
    'use strict';

    var list = $('.js-height');
    if (list.length) {
        list.each(function () {
            // Считаем кол-во итемов в одном ряду
            var oThis;
            var item;
            var listW;
            var itemW;
            var quant;

            oThis = $(this);// Текущий список
            item = oThis.find('.item');// Массив элементов текущего списка
            listW = oThis.width();// Ширина текущего ряда в списке
            itemW = item.outerWidth();// Ширина элемента
            quant = Math.round(listW / itemW);// Кол-во элементов в одном ряду

            // Скидываем минимальную высоту для всех элементов
            item.each(function () {
                $(this).find('.js-trg').css({
                    'height': ''
                });
            });

            // Расставляем для каждых n элементов минимальную высоту, если их больше одного
            if (quant > 1) {
                var itemL;
                var end;
                var rowItems;
                var i;
                var itemInRowH;
                var maxH;

                itemL = item.length;
                for (i = 0; i < itemL;) {
                    maxH = 0;
                    end = i + quant;
                    rowItems = item.slice(i, end);
                    var n = null;
                    var m = null;
                    for (n = 0; n < rowItems.length; n++) {
                        itemInRowH = $(rowItems[n]).find('.js-trg').outerHeight();
                        if (itemInRowH > maxH) {
                            maxH = itemInRowH;
                        }
                    }
                    for (m = 0; m < rowItems.length; m++) {
                        $(rowItems[m]).find('.js-trg').css({
                            'height': maxH
                        });
                    }
                    i += quant;
                }
            }
        });
    }
}

!function () {
    'use strict';

    var oWindow = $(window);

    $(function () {
        listAutoHeight();
    });

    oWindow.on('load', function () {
        listAutoHeight();
    });

    oWindow.on('resize', function () {
       listAutoHeight();
    });
}();