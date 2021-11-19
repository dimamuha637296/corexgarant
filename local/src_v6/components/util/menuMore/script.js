!function () {
    'use strict';

    function MenuMore() {}

    MenuMore.prototype.returnItems = function () {
        var html = this.submenu.html();
        if (html !== undefined && html.length) {
            this.moreItem.before(html);
            this.submenu.empty();
        }
        this.moreItem.removeClass('shown');
    };

    MenuMore.prototype.checkMenu = function () {
        this.calls += 1;
        if (this.calls < this.maxCalls) {
            if (this.menu.outerWidth() > this.block.outerWidth() && this.menu.children('.item_1').length > 2) {
                this.cutItem();
            }
        }
    };

    MenuMore.prototype.cutItem = function () {
        var lastItem = this.menu.children('.item_1').not(':first-child, .more').last().detach();
        this.submenu.prepend(lastItem);
        this.moreItem.addClass('shown');
        this.checkMenu();
    };

    MenuMore.prototype.buildMenu = function () {
        var app = this;
        this.calls = 0;
        if (getInnerWidth() >= this.minWindowWidth) {
            app.itemHeight = app.items.outerHeight();
            app.returnItems();
            app.checkMenu();
        }
        setTimeout(function () {
            app.block.removeClass('not-inited');
        }, 1000);
    };

    MenuMore.prototype.setHandlers = function () {
        var app = this;
        this.window.on('load', function () {
            app.buildMenu();
        });

        this.window.on('resize', function () {
            app.block.addClass('not-inited');
            clearTimeout(app.timer);
            app.timer = setTimeout(function () {
                app.buildMenu();
            }, 300);
        });
    };

    MenuMore.prototype.init = function (menu) {
        this.block = menu;
        this.moreItem = this.block.find('.more');
        if (!this.moreItem.length) {
            console.error('Нет блока "Ещё"');
        }
        this.minWindowWidth = ws.const.screen.grid_breakpoint_min;
        this.menu = this.block.find('.menu_level_1');
        this.items = this.block.find('.item_1');
        this.submenu = this.moreItem.find('.menu_level_2');
        this.timer = null;
        this.block.addClass('not-inited');
        this.maxCalls = 100;
        this.window = $(window);
        this.buildMenu();
        this.setHandlers();
    };

    function menuMore() {
        var menu =  $('.js-menuMore');
        if (menu.length) {
            menu.each(function () {
                (new MenuMore()).init($(this));
            });
        }
    }

    $(function () {
        menuMore();
    });
}();