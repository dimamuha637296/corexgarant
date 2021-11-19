!function () {
    'use strict';

    var fixedMenu = {

        showFixedMenu: function () {
            this.block.addClass('active');
        },

        hideFixedMenu: function () {
            this.block.removeClass('active');
        },

        findMenuPosition: function () {
            this.data.isMenuFixed = this.window.scrollTop() > this.fixedMenu[0].getBoundingClientRect().bottom;
            if (this.data.isMenuFixed) {
                this.showFixedMenu();
            } else {
                this.hideFixedMenu();
            }
        },

        setScrollHandler: function () {
            var app = this;
            this.window.off('scroll.fixedMenu').on('scroll.fixedMenu', function () {
                app.findMenuPosition();
            });
        },

        setResizeHandler: function () {
            var app = this;
            this.timer = null;
            this.window.off('resize.fixedMenu').on('resize.fixedMenu', function () {
                clearTimeout(app.timer);
                app.timer = setTimeout(function () {
                    app.data.mobView = getInnerWidth() < ws.const.screen.grid_breakpoint_min;
                    if (app.data.mobView) {
                        app.window.off('scroll.fixedMenu');
                        app.hideFixedMenu();
                    } else {
                        app.setScrollHandler();
                        app.findMenuPosition();
                    }
                }, 300);
            });
        },

        initCfg: function () {
            this.window = $(window);
            this.data = {};
            this.data.mobView = getInnerWidth() < ws.const.screen.grid_breakpoint_min;
            this.scrollStart = $(window).scrollTop();
        },

        init: function () {
            this.block = $('.fixed-header-2');
            this.fixedMenu = $('.js-fixed-menu');
            if (!this.block.length || !this.fixedMenu.length) {
                return false;
            }
            this.initCfg();
            this.findMenuPosition();
            if (!this.data.mobView) {
                this.setScrollHandler();
            }
            this.setResizeHandler();
        }
    };

    $(function () {
        fixedMenu.init();
    });
}();