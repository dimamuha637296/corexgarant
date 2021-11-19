!function () {
    'use strict';

    function MenuTablet() {}

    MenuTablet.prototype.initBackdrop = function (self) {
        var app = this;
        var backdrop = self.find('.backdrop');
        if (!backdrop.length) {
            backdrop = $('<div class="backdrop"></div>');
            var submenu = self.closest('.submenu');
            if (submenu.length) {
                backdrop.prependTo(submenu);
            } else {
                backdrop.insertBefore(self);
                backdrop.addClass('outer');
            }
            backdrop.off('click.menuTablet').on('click.menuTablet', function () {
                var $this = $(this);
                if ($this.hasClass('outer')) {
                    app.block.find('.backdrop').remove();
                    app.block.find('.touched').removeClass('touched');
                } else {
                    $this.remove();
                    self.removeClass('touched');
                }
            });
        }
    };

    MenuTablet.prototype.setClickHandler = function () {
        var app = this;
        this.items.each(function () {
            var item = $(this);
            var submenu = item.siblings('.submenu');
            if (!submenu.hasClass('collapse') && submenu.css('display') === 'none') {
                item.off('click.menuTablet').on('click.menuTablet', function (e) {
                    var self = $(this);
                    if (!self.hasClass('touched')) {
                        e.preventDefault();
                        self.addClass('touched');
                        app.initBackdrop(self);
                    }
                });
            }
        });
    };

    MenuTablet.prototype.init = function (menu) {
        this.block = menu;
        if (!Modernizr.touchevents) {
            return false;
        }
        this.items = this.block.find('[class*=item_]').has('.submenu').children('a, span');
        this.setClickHandler(this.block);
    };

    function menuTablet() {
        var trg = $('.js-menu-tablet');
        if (!trg.length) {
            return false;
        }
        (new MenuTablet()).init(trg);
    }

    $(function () {
        menuTablet();
    });
}();