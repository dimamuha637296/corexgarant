
'use strict';

function buyScriptInit(params) {

    var app = {

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


        // Возвращаем значения от min до max
        _minMax: function (_vl) {
            if (_vl < 1 || isNaN(_vl)) {
                _vl = 0;
            }
            /*пока проверки на максимальное число нет
             if( _vl > max ){
             _vl = max;
             }*/
            return _vl;
        },


        // Обработчик клика на кнопку
        _btnHandler: function (btn, quantArea, plus) {
            btn.on('click', function () {
                var _vl = parseInt(quantArea.val());
                if (plus === true) {
                    _vl = _vl + 1;
                } else {
                    _vl = _vl - 1;
                }
                _vl = app._minMax(_vl);
                quantArea.val(_vl).trigger('change');
            });
        },


        // Обработчик кнопки плюс-минус
        plusMinus: function (self) {

            // Класс количества
            var quantArea = self.find('.' + params.QUANTITY_CLASS);

            // Класс кнопки плюс
            var quantBtnPlus = self.find('.btn-up');

            // Класс кнопки минус
            var quantBtnMinus = self.find('.btn-down');

            // Вызываем обработчики
            this._btnHandler(quantBtnMinus, quantArea, false);
            this._btnHandler(quantBtnPlus, quantArea, true);
        },


        // Оставляем ввод только цифр
        setOnlyDigits: function (self) {

            // Класс количества
            var quantityInput = self.find('.' + params.QUANTITY_CLASS);

            // На нажатии клавиши запрещаем вводить все кроме цифр и точки
            quantityInput.on('keydown', function (event) {
                if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 110 ||
                    (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39)) {
                    return false;
                } else {
                    if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                        event.preventDefault();
                    }
                }
            });
        },


        // Установить активность блока
        setDisabled: function (_self) {

            // Поменять текст в кнопке
            _self.html(params.BUTTON_TEXT);

            // Добавить класс disabled
            _self.addClass(params.DISABLE_CLASS);

            // Проверяем, чтоб было включено количество
            if (params.QUANTITY_ACTIVATE == 'Y') {

                // Находим блок с плюс/минус
                var quantAreaClass = _self.closest('.' + params.AREA_CLASS).find('.' + params.QUANTITY_AREA_CLASS);

                // Скрыть блок с плюс/минус
                if (quantAreaClass.length) {
                    quantAreaClass.hide();
                }
            }
        },


        // Клик по кнопке добавить в корзину
        addBtn: function (self) {

            var _self = self.find('.' + params.BUTTON_CLASS);
            var quantity = 1;

            _self.on('click', function (e) {
                e.preventDefault();

                // Если включена анимация корзины
                if (params.FLY_ACTIVATE == 'Y') {

                    // Вызываем функцию анимации
                    app.fly(_self, params);
                }

                // Если кнопка не disabled
                if (!_self.hasClass(params.DISABLE_CLASS)) {

                    // Количество в инпуте
                    var quantityInput = self.find('.' + params.QUANTITY_CLASS);
                    if (quantityInput.length) {
                        quantity = quantityInput.val();
                    }

                    // ID блока
                    var goodsID = self.data('id');

                    // Вызываем аякс
                    $.ajax({
                            method: 'POST',
                            url: params.TEMPLATE_FOLDER + '/ajax.php',
                            data: {
                                action: 'addInBasket',
                                id: goodsID,
                                quantity: quantity,
                                basket: params.PATH_TO_BASKET,
                                order: params.PATH_TO_ORDER,
                                currency: params.CURRENCY
                            }
                        })
                        .done(function (msg) {
                            if (msg !== 'ERROR') {
                                $('#basket_small_products').text(msg);

                                // Установить активность блока
                                app.setDisabled(_self);
                            }
                        });
                }
            });
        },

        // Пройти по активным пунктам и вписать им "Уже в корзине"
        setActive: function (items) {
            // Если есть item и есть .catalog-item
            if (typeof items !== 'undefined' && $('.' + params.AREA_CLASS).length) {
                items.forEach(function (item, i, arr) {

                    // Ищем кнопку "В корзину"
                    var self = $('[data-id="' + item + '"]').find('.' + params.BUTTON_CLASS);

                    // Установить активность блока
                    app.setDisabled(self);
                });
            }
        },

        // Инициализация приложения
        init: function() {

            // Проходим циклом по массиву блоков
            $('.' + params.AREA_CLASS).each(function () {
                var self = $(this);

                // Проверяем, чтоб было включено количество
                if (params.QUANTITY_ACTIVATE == 'Y') {

                    // Оставляем ввод только цифр
                    app.setOnlyDigits(self);

                    // Обработчик клика на плюс-минус
                    app.plusMinus(self);
                }

                // Клик по кнопке добавить в корзину
                app.addBtn(self);
            });


            // Пройти по активным пунктам и вписать им "Уже в корзине"
            this.setActive(params.BASKET_ITEMS_ID);

            // Запрещаем переход по ссылке
            return false;
        }
    };

    // вызов приложения
    app.init();
}
