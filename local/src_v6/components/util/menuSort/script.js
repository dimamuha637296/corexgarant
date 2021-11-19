!function () {
    'use strict';

    function MenuSort() {}

    MenuSort.prototype.getMenuHeight = function () {
        var data = this._data;
        var minHeight = 9999;
        var menuName;
        var iter = 99;
        for (var key in data.menus) {
            if (iter < 0) {
                return false;
            }
            iter--;
            if (!data.menus.hasOwnProperty(key)) {
                return false;
            }
            var elementHeight = data.menus[key].outerHeight();
            if (minHeight > elementHeight) {
                minHeight = elementHeight;
                menuName = key;
            }
        }
        return menuName;
    };

    MenuSort.prototype.sortMenu = function () {
        var app = this;
        var data = this._data;
        var selector = this._selector;

        selector.body.addClass(data.initClass);
        data.menus = {};
        data.menus.menu1 = this.block.find('.js-menu');
        selector.menuInner = data.menus.menu1.closest('.js-menu-inner');
        data.columns = Math.round(selector.menuInner.outerWidth() / data.menus.menu1.outerWidth());
        selector.items.detach();
        selector.menuInner.find('.menu_level_2').not('.js-menu').remove();
        for (var i = 2; i <= data.columns; i++) {
            data.menus['menu' + i] = $('<ul class="break-word list-reset menu_level_2"></ul>').appendTo(data.menus.menu1.parent());
        }
        selector.items.each(function () {
            data.menus[app.getMenuHeight()].append(this);
        });
        selector.body.removeClass(data.initClass);
    };

    MenuSort.prototype.setHandlers = function () {
        var app = this;
        var window = this._selector.window;
        window.on('load', function () {
            app.sortMenu();
        });
        window.on('resize', function () {
            clearTimeout(app._data.timer);
            app._data.timer = setTimeout(function () {
                app.sortMenu();
            }, 150);
        });
    };

    MenuSort.prototype.initCfg = function () {
        this._data = {
            menus: null,
            columns: null,
            timer: null,
            initClass: 'menuSort-init'
        };
        this._selector = {
            body: $('body'),
            window: $(window)
        };
        this._selector.items = this.block.find('.js-item');
        this.sortMenu();
        this.setHandlers();
    };

    MenuSort.prototype.init = function (menu) {
        this.block = menu;
        this.initCfg();
    };

    function menuSort() {
        var menu = $('.js-menu-sort');
        if (menu.length) {
            menu.each(function () {
                (new MenuSort()).init($(this));
            });
        }
    }

    $(function () {
        menuSort();
    });
}();