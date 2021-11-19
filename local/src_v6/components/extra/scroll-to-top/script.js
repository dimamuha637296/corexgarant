!function () {
    'use strict';

    /**
     * @class ScrollToTop Кнопка скролла наверх страницы
     */
    var ScrollToTop = {

        /**
         * Показать блок
         * @method show
         */
        show: function () {
            this._selector.block.show(this._const.visibiliyChangeSpeed);
        },

        /**
         * Спрятать блок
         * @method show
         */
        hide: function () {
            this._selector.block.hide(this._const.visibiliyChangeSpeed);
        },

        /**
         * Выставить видимость блока
         * @method toggleVisibility
         */
        toggleVisibility: function () {
            if (this._data.pageHeight > this._const.minVisiblePageHeight) {
                if (this._selector.window.scrollTop() >= this._const.showHeight) {
                    this.show();
                } else {
                    this.hide();
                }
            } else {
                this.hide();
            }
        },

        /**
         * Скроллинг наверх
         * @method scrollToTop
         */
        scrollToTop: function () {
            this._selector.page.animate({scrollTop: this._const.scrollTopPosition}, this._const.scrollSpeed);
        },

        /**
         * Установить высоту страницы
         * @method getPageHeight
         */
        getPageHeight: function () {
            this._data.pageHeight = document.documentElement.scrollHeight;
        },

        /**
         * Привязать обработчики
         * @method bindHandlers
         */
        bindHandlers: function () {
            var app = this;

            this._selector.window.off('load.' + this._const.moduleName).on('load.' + this._const.moduleName, function() {
                app.getPageHeight();
                app.toggleVisibility();
            });
            this._selector.window.off('resize.' + this._const.moduleName).on('resize.' + this._const.moduleName, function() {
                app.getPageHeight();
                app.toggleVisibility();
            });
            this._selector.window.off('scroll.' + this._const.moduleName).on('scroll.' + this._const.moduleName, function() {
                app.toggleVisibility();
            });
            this._selector.block.off('click.' + this._const.moduleName).on('click.' + this._const.moduleName, function() {
                app.scrollToTop();
            });
        },

        /**
         * Инициализировать параметры
         * @method initParams
         */
        initParams: function () {
            this._const = {
                moduleName: 'ScrollToTop', // Имя модуля
                minVisiblePageHeight: 3000, // Минимальная высота страницы для отображения блока
                showHeight: 400, // Высота после покоторой показывается блок
                visibiliyChangeSpeed: 100, // Скорость изменения видимости блока
                scrollSpeed: 500, // Скорость скроллинга
                scrollTopPosition: 0 // Вертикальная позиция страницы к которой происходит скроллинг при нажатии на кнопку
            };
            this._data = {
                pageHeight: document.documentElement.scrollHeight // Высота страницы
            };
            this._selector = {
                block: $('.scroll-to-top'),
                window: $(window),
                page: $('html, body')
            };
        },

        /**
         * Инициализация
         * @method init
         */
        init: function () {
            this.initParams();
            if (!this._selector.block.length) {
                return false;
            }
            this.bindHandlers();
        }
    };

    $(function () {
        ScrollToTop.init();
    });
}();