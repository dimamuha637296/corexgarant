!function () {
    'use strict';

    var wsMobileMenu = {

        scrollBugFix: function() {
            var app = this;
            var scrolling = false;
            // Prevent body scroll
            $(document).off('touchmove.ws').on('touchmove.ws', function (e) {
                if (app.html.hasClass('pm-block')) {
                    e.preventDefault();
                }
            });

            this.body.off('touchstart.ws').on('touchstart.ws', '.pm-inner', function (e) {
                if (app.html.hasClass('pm-block')) {
                    if (!scrolling) {
                        scrolling = true;
                        if (e.currentTarget.scrollTop === 0) {
                            e.currentTarget.scrollTop = 1;
                        } else if (e.currentTarget.scrollHeight === e.currentTarget.scrollTop + e.currentTarget.offsetHeight) {
                            e.currentTarget.scrollTop -= 1;
                        }
                        scrolling = false;
                    }
                }
            });
            this.body.off('touchmove.ws').on('touchmove.ws', '.pm-inner', function (e) {
                if (app.html.hasClass('pm-block')) {
                    if ($(this)[0].scrollHeight > $(this).innerHeight()) {
                        e.stopPropagation();
                    }
                }
            });
            // Fix issue after device rotation change
            this.window.off('orientationchange.ws').on('orientationchange.ws', function () {
                    $('.pm-inner')
                        .scrollTop(0)
                        .css({ '-webkit-overflow-scrolling': 'auto' })
                        .css({ '-webkit-overflow-scrolling': 'touch' });
                });
        },

        setSwipeHandler: function() {
            var app = this;
            //http://labs.rampinteractive.co.uk/touchSwipe/docs/tutorial-Any_finger_swipe.html
            if (this.backdrop.length && $.fn.swipe) {
                this.backdrop.swipe({
                    swipeLeft: function (/*event, direction, distance, duration, fingerCount, fingerData, currentDirection*/) {
                        app.pushMenuHide();
                    },
                    swipeUp: function (/*event, direction, distance, duration, fingerCount, fingerData, currentDirection*/) {
                        return false;
                    },
                    swipeDown: function (/*event, direction, distance, duration, fingerCount, fingerData, currentDirection*/) {
                        return false;
                    },
                    tap: function (/*event, direction, distance, duration, fingerCount, fingerData, currentDirection*/) {
                        app.pushMenuHide();
                    },
                    threshold: 0,
                    fingers: 'all'
                });
            }
        },

        pushMenuShow: function() {
            this.html.addClass(this._const.class.blockClass);
            this.body.addClass(this._const.class.openClass).removeClass(this._const.class.closeClass);
            if (!this._const.pushSite) {
                this.body.css('padding-right', this._const.bodyPad + this._const.scrollbarWidth);
                this.gheader.css('padding-right', this._const.bodyPad + this._const.scrollbarWidth);
            }
            this.openBtn.addClass('opened').removeClass('closed');
            this.closeBtn.addClass('opened').removeClass('closed');
            this.scrollBugFix();
            this.setSwipeHandler();
        },

        pushMenuHide: function() {
            this.html.removeClass(this._const.class.blockClass);
            this.body.addClass(this._const.class.closeClass).removeClass(this._const.class.openClass);
            if (!this._const.pushSite) {
                this.body.css('padding-right', this._const.bodyPad);
                this.gheader.css('padding-right', this._const.bodyPad);
            }
            this.openBtn.addClass('closed').removeClass('opened');
            this.closeBtn.addClass('closed').removeClass('opened');
            if (this.backdrop.length && $.fn.swipe) {
                this.backdrop.swipe('destroy');
            }
        },

        checkScrollWidth: function () {
            //https://davidwalsh.name/detect-scrollbar-width
            var scrollDiv = document.createElement('div');
            scrollDiv.className = 'modal-scrollbar-measure';
            this.body.append(scrollDiv);
            this._const.scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
            this.body[0].removeChild(scrollDiv);
        },

        setClickHandlers: function () {
            var app = this;
            if (this._data.workApp) {
                this.openBtn.off('click.wsMobileMenu touch.wsMobileMenu').on('click.wsMobileMenu touch.wsMobileMenu', function () {
                    app.pushMenuShow();
                });
                this.closeBtn.off('click.wsMobileMenu touch.wsMobileMenu').on('click.wsMobileMenu touch.wsMobileMenu', function () {
                    app.pushMenuHide();
                });
            } else {
                app.pushMenuHide();
                this.closeBtn.off('click.wsMobileMenu touch.wsMobileMenu');
                this.openBtn.off('click.wsMobileMenu touch.wsMobileMenu');
            }
        },

        setResizeHandler: function () {
            var app = this;
            this.window.off('resize.wsMobileMenu').on('resize.wsMobileMenu', function () {
                clearTimeout(app.timer);
                app.timer = setTimeout(function () {
                    app._data.workApp = getInnerWidth() < ws.const.screen.grid_breakpoint_max;
                    app.setClickHandlers();
                }, 300);
            });
        },

        initCfg: function () {
            this.window = $(window);
            this.html = $('html');
            this.body = $('body');
            this.gheader = $('.g-header');
            this.timer = null;
            this._data = {};
            this._const = {
                bodyPad: parseInt(this.body.css('padding-right')),
                pushSite: this.block.hasClass('js-push-site')
            };
            this._const.class = {
                openClass: 'pm-open',
                blockClass: 'pm-block',
                closeClass: 'pm-close'
            };
            this._data.workApp = getInnerWidth() < ws.const.screen.grid_breakpoint_max;
            this.openBtn = $('.pm-opener');
            this.backdrop = this.block.find('.pm-backdrop');
            this.closeBtn = this.block.find('.pm-backdrop, .pm-closer');
            if (this._const.pushSite) {
                this.body.addClass('pm-push');
            }
        },

        init: function() {
            this.block = $('.pm');
            if (!this.block.length) {
                return false;
            }
            this.initCfg();
            this.setResizeHandler();
            this.setClickHandlers();
            this.checkScrollWidth();
        }
    };

    $(function () {
        wsMobileMenu.init();
    });
}();