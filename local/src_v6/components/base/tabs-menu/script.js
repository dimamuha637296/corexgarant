!function () {
    'use strict';

    function TabsMenu() {}

    TabsMenu.prototype.mobView = function () {
        var app = this;
        var itemsWidth = null;
        this.selector.items.each(function () {
            itemsWidth += $(this).width();
        });
        if (itemsWidth > this.selector.menu.width()) {
            this.selector.menuWrap.addClass('blur-right');
            this.selector.menu.off('touchmove.TabsMenu scroll.TabsMenu').on('touchmove.TabsMenu scroll.TabsMenu', function() {
                app.setBlurBorders();
            });
        }
    };

    TabsMenu.prototype.setBlurBorders = function () {
        var scrollCoord = this.selector.menu.scrollLeft();
        var scrollEndCoord = this.selector.menu.prop("scrollWidth") - this.selector.menu.width();
        if (scrollCoord === 0) {
            this.selector.menuWrap.addClass('blur-right')
                .removeClass('blur-left')
                .removeClass('scrolling');
        } else if (scrollCoord !== 0 && scrollCoord !== scrollEndCoord) {
            this.selector.menuWrap.addClass('scrolling')
                .removeClass('blur-left')
                .removeClass('blur-right');
        } else if (scrollCoord === scrollEndCoord) {
            this.selector.menuWrap.addClass('blur-left')
                .removeClass('scrolling')
                .removeClass('blur-right');
        }
    };

    TabsMenu.prototype.activeMoreBtn = function () {
        var activeSubmenuItem = this.selector.submenu.find('.tabs-menu__item .active');
        if (activeSubmenuItem.length) {
            this.selector.moreItemLink.addClass('active');
        } else {
            this.selector.moreItemLink.removeClass('active');
        }
    };

    TabsMenu.prototype.returnItems = function () {
        var app = this;
        var items = this.selector.submenu.find('.tabs-menu__item');
        if (items !== undefined && items.length > 0) {
            app.selector.moreItem.before(items);
            this.selector.submenu.empty();
        }
        this.selector.moreItem.removeClass(this.const.dropVisible);
    };

    TabsMenu.prototype.checkMenu = function () {
        this.data.callsCount += 1;
        if (this.data.callsCount < this.const.maxCallsCount) {
            if (this.selector.menu.outerHeight() > this.selector.items.first().outerHeight() && this.selector.menu.children('.tabs-menu__item').length > 2) {
                this.cutItem();
            }
        }
    };

    TabsMenu.prototype.cutItem = function () {
        var lastItem = this.selector.menu.children('.tabs-menu__item').not(':first-child, .tabs-menu__item--more').last().detach();
        this.selector.submenu.prepend(lastItem);
        this.selector.moreItem.addClass(this.const.dropVisible);
        this.checkMenu();
    };

    TabsMenu.prototype.buildMenu = function () {
        this.returnItems();
        this.checkMenu();
    };

    TabsMenu.prototype.setResizeHandler = function () {
        var app = this;
        this.selector.window.off('resize.TabsMenu.' + this.const.uuid).on('resize.TabsMenu.' + this.const.uuid, function () {
            clearTimeout(app.data.timer);
            app.data.timer = setTimeout(function () {
                if (app.data.touchView) {
                    app.returnItems();
                    app.mobView();
                } else {
                    app.buildMenu();
                    app.activeMoreBtn();
                }
            }, 200);
        });
    };

    TabsMenu.prototype.iniCfg = function () {
        this.selector = {
            window: $(window),
            menuWrap: this.block.find('.tabs-menu__inner'),
            menu: this.block.find('.tabs-menu__list'),
            items: this.block.find('.tabs-menu__item').not('.tabs-menu__item--more'),
            moreItem: this.block.find('.tabs-menu__item--more')
        };
        this.selector.submenu = this.selector.menu.find('.dropdown-menu');
        this.selector.moreItemLink = this.selector.moreItem.find('> a');
        this.const = {
            dropVisible: 'tabs-menu__item--more--visible',
            maxCallsCount: 100,
            uuid: Math.random().toString(36).substr(2, 9)
        };
        this.data = {
            callsCount: 0,
            touchView: device.default.mobile() || device.default.tablet(),
            timer: null
        };
    };

    TabsMenu.prototype.init = function (block) {
        this.block = block;
        this.iniCfg();
        if (this.data.touchView) {
            this.mobView();
        } else {
            this.buildMenu();
            this.activeMoreBtn();
        }
        this.setResizeHandler();
    };

    function tabsMenu() {
        var menu = $('.tabs-menu');
        if (!menu.length) {
            return false;
        }
        menu.each(function () {
            (new TabsMenu()).init($(this));
        });
    }

    $(window).on('load', function () {
        tabsMenu();
    });
}();