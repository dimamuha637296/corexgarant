(function () {
    'use strict';

    function MenuScroll() {}

    MenuScroll.prototype.setScrollBar = function () {
        var data = this.data;
        var selector = this.selector;
        selector.body.addClass('js-scroll-init');
        if (data.submenuHeight < selector.blockInner.outerHeight() && !data.scrollBarInited) {
            mCustomScrollbar.init(this.block);
            data.scrollBarInited = true;
        } else if (data.submenuHeight >= selector.blockInner.outerHeight() && data.scrollBarInited) {
            this.block.mCustomScrollbar('destroy');
            data.scrollBarInited = false;
        }
        selector.body.removeClass('js-scroll-init');
    };

    MenuScroll.prototype.setHandlers = function () {
        var app = this;
        this.window = $(window);
        this.timer = null;
        this.window.on('resize', function () {
            clearTimeout(app.timer);
            app.timer = setTimeout(function () {
                app.data.submenuHeight = app.block.outerHeight();
                app.setScrollBar();
            }, 300);

        });
        this.window.on('load', function () {
            app.setScrollBar();
        });
        if (this.selector.collapse.length && !this.data.scrollBarInited) {
            this.selector.collapse.on('shown.bs.collapse', function () {
                app.setScrollBar();
            });
        }
    };

    MenuScroll.prototype.initCfg = function () {
        this.data = {
            scrollBarInited: false
        };
        this.data.submenuHeight = this.block.outerHeight();
        this.selector = {};
        this.selector.collapse = this.block.find('.collapse');
        this.selector.blockInner = this.block.find('.js-submenu-inner');
        if (!this.selector.blockInner.length) {
            console.error('Отсутствует блок необходимый для работы скрипта');
        }
        this.selector.body = $('body');
        this.setHandlers();
    };

    MenuScroll.prototype.init = function (menu) {
        this.block = menu;
        this.initCfg();
    };

    function menuScroll() {
        var menu = $('.js-submenu-scroll');
        if (!menu.length) {
            return false;
        }
        menu.each(function () {
            (new MenuScroll()).init($(this));
        });
    }

    $(function () {
        menuScroll();
    });

})();