!function () {
    'use strict';

    /**
     * @class wsPages Список страниц проекта
     */
    var wsPages = {

        /**
         * Рассчитать ширину скроллбара
         * @method calcScrollbarWidth
         * @return {Number} ширина скроллбара
         */
        calcScrollbarWidth: function () {
            return window.innerWidth - document.documentElement.clientWidth;
        },

        /**
         * Показать
         * @method show
         */
        show: function () {
            this._selector.block.addClass(this._const.activeBlockClass);
            this._selector.body.css({
                'padding-right': this.calcScrollbarWidth() + 'px',
                'overflow': 'hidden'
            });
            this._data.isOpened = true;
        },

        /**
         * Спрятать
         * @method hide
         */
        hide: function () {
            this._selector.block.removeClass(this._const.activeBlockClass);
            this._selector.body.css({
                'padding-right': '',
                'overflow': ''
            });
            this._data.isOpened = false;
        },

        /**
         * Переключить состояние
         * @method toggle
         */
        toggle: function () {
            if (this._data.isOpened === true) {
                this.hide();
            } else {
                this.show();
            }
        },

        /**
         * Привязать обработчики
         * @method bindHandlers
         */
        bindHandlers: function () {
            var app = this;
            this._selector.toggleBtn.off('click.' + this._const.moduleName).on('click.' + this._const.moduleName, function (e) {
                e.preventDefault();
                app.toggle();
            });
            this._selector.backdrop.off('click.' + this._const.moduleName).on('click.' + this._const.moduleName, function (e) {
                e.preventDefault();
                app.hide();
            });
            this._selector.window.off('resize.' + this._const.moduleName).on('resize.' + this._const.moduleName, function () {
                app.hide();
            });
        },

        /**
         * Создать HTML меню
         * @method createMenuLevelHtml
         * @param {Object} params - параметры
         * @param {String} params.name - имя меню
         * @param {Number} params.level - уровень меню
         * @param {Array} params.structure - структура меню
         *
         * @return {String} HTML меню
         */
        createMenuLevelHtml: function (params) {
            var app = this;
            var name = params.name || '';
            var level = params.level || 1;
            var structure = params.structure || [];

            var html = '<ul class="menu_level_' + level + ' list-reset break-word">';
            structure.forEach(function (item, itemIndex) {
                if (item.type === 'file') {
                    html +=
                        '<li class="item_' + level + '">' +
                        '   <a href="' + item.path + '"><span>' + item.name + '.html</span></a>' +
                        '</li>';
                } else if (item.type === 'folder') {
                    html +=
                        '<li class="item_' + level + '">' +
                        '   <span><span>' + item.name + '</span></span>' +
                        '   <a class="icon collapsed" data-toggle="collapse" href="#level-' + name + '-' + level + '-' + itemIndex + '"></a>' +
                        '   <div class="collapse submenu" id="level-' + name + '-' + level + '-' + itemIndex + '">';
                    html += app.createMenuLevelHtml({
                        name: name,
                        level: level + 1,
                        structure: item.structure,
                        pagesFolder: params.pagesFolder
                    });
                    html +=
                        '   </div>' +
                        '</li>';
                }
            });
            html += '</ul>';

            return html;
        },

        /**
         * Вставить HTML
         * @method insertHtml
         */
        insertHtml: function () {
            this._selector.block = $(this._data.menuHtml).appendTo(this._selector.body);
            this._selector.backdrop = this._selector.block.find('.ws_pages__backdrop');
            this._selector.toggleBtn = this._selector.block.find('.ws_pages__toggle-btn');
        },

        /**
         * Создать HTML
         * @method createHtml
         */
        createHtml: function () {
            var app = this;
            this._data.menuHtml =
                '<div class="ws_pages" style="display: none;">' +
                '   <div class="ws_pages__body">' +
                '       <div class="ws_pages__inner">' +
                '           <div class="ws_pages__menu">';
            ws.module.pages.menuList.forEach(function (item) {
                app._data.menuHtml += app.createMenuLevelHtml(item);
            });
            this._data.menuHtml +=
                '           </div>' +
                '       </div>' +
                '       <button class="ws_pages__toggle-btn">' +
                '           <i class="ws_pages__icon"></i>' +
                '       </button>' +
                '   </div>' +
                '   <div class="ws_pages__backdrop"></div>' +
                '</div>';
        },

        /**
         * Инициализация параметров
         * @method initParams
         */
        initParams: function () {
            this._const = {
                moduleName: 'wsPages',
                activeBlockClass: 'active',
                initedBlockClass: 'inited'
            };
            this._data = {
                isOpened: false
            };
            this._selector = {
                window: $(window),
                body: $('body')
            };
        },

        /**
         * Инициализация
         * @method init
         */
        init: function () {
            this.initParams();
            this.createHtml();
            this.insertHtml();
            this.bindHandlers();
            this._selector.block.addClass(this._const.initedBlockClass);
        }
    };

    $(function () {
        wsPages.init();
    });
}();