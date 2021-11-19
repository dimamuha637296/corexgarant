
'use strict';

function compareScriptInit(params) {
    var app = {

        // Удаление из сравнения
        compareDelete: function () {

            // При клике на документ, смотрим что кликнули по классу RESULT_CLOSE_ICON_CLASS
            $(document).on('click', '.' + params.RESULT_CLOSE_ICON_CLASS, function () {
                var self = $(this);
                var goodsID2 = self.data('id');
                app.compareAjax(params, goodsID2, 'DELETE_FROM_COMPARE_LIST');
            });
        },

        // Аякс сравнения
        compareAjax: function (params, goodsID, action) {
            $.ajax({
                method: "POST",
                url: params.TEMPLATE_FOLDER + '/ajax.php',
                data: {id: goodsID, action: action, AJAX_UPD: 'Y', IBLOCK_ID: params.IBLOCK_ID},
                success: function (result) {
                    if (result.length > 20) {
                        $('.compair-prod a').html(result).show();
                    } else {
                        $('.compair-prod a').hide();
                    }
                }
            });
        },

        // Анимация полета
        fly_animate: function (item, x_stop, y_stop) {
            item.animate({
                    top: y_stop + 20,
                    left: x_stop + 30,
                    height: 0
                }, 500,
                function () {
                    // Удаляем клонированную картинку после анимации
                    item.remove();
                });
        },

        // Функция Летающей корзины
        fly: function (button, par) {

            // Определяем настройки
            var btn = button;// Кнопка, которая вызвала анимацию
            var trg = $('.' + par.TARGET_CLASS);// класс, в какую точку летит анимация
            var img = btn.closest('.' + par.AREA_CLASS).find('.' + par.IMAGE_CLASS);// картинка с блока, которая будет анимироваться

            if (btn.length && trg.length && img.length) {

                //Определяем координаты
                var x_start = img.offset().left;
                var y_start = img.offset().top;
                var x_stop = trg.offset().left;
                var y_stop = trg.offset().top;

                // Клонируем картинку
                var item = img.clone().addClass('fly').appendTo('body').css({
                    top: y_start,
                    left: x_start
                });

                // Вызываем анимацию
                this.fly_animate(item, x_stop, y_stop);
            }
        },

        // Ставим обработчики инпутов
        checkboxHandlers: function () {

            // Цикл по инпутам сравнения
            $('.' + params.AREA_CLASS).each(function () {

                var self = $(this);

                // инпут сравнения
                var button = self.find('input.' + params.BUTTON_CLASS);

                // дата-атрибут id
                var goodsID = self.data('id');

                // Проверка, существует ли ID товара
                if (goodsID === 'undefined') {
                    console.error('нет ID товара на элементе .' + self.attr('class'));
                }

                // Если есть отмеченные чекбоксы и среди них есть текущий пункт
                if (params.KEYS.length > 0 && $.inArray(parseInt(goodsID), params.KEYS) >= 0) {
                    // Отмечаем чекбокс
                    button.prop('checked', 'checked')
                        //Обновляем состояние чекбокса
                        .trigger('refresh');
                }

                // При изменении чекбокса
                button.on('change', function (e) {

                    // Действие по умолчанию для аякса сравнения
                    var action = 'DELETE_FROM_COMPARE_LIST';
                    var _self = $(this);

                    // Если чекбокс отмечен
                    if (_self.prop('checked')) {

                        // Если включена анимация корзины
                        if (params.FLY_ACTIVATE == 'Y') {

                            // Вызываем функцию анимации
                            app.fly(_self, params);
                        }

                        // Меняем действие для аякса сравнения
                        action = 'ADD_TO_COMPARE_LIST';
                    }

                    // Аякс сравнения
                    app.compareAjax(params, goodsID, action);
                });
            });
        },

        // Инициализация приложения
        init: function() {
            this.checkboxHandlers();
            this.compareDelete();
        }
    };

    // вызов приложения
    app.init();
}
