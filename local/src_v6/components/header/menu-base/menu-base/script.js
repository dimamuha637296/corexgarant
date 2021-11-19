!function () {
    'use strict';

    var oWindow = $(window);

    //ширина скролла
    function widthScrollBar() {
        var div = document.createElement('div');
        div.style.overflowY = 'scroll';
        div.style.width = '50px';
        div.style.height = '50px';
        div.style.visibility = 'hidden';
        document.body.appendChild(div);
        var scrollWidth = div.offsetWidth - div.clientWidth;
        document.body.removeChild(div);
        return scrollWidth;
    }

    // modal open padding header
    function modalHeader() {
        var modal = $('.modal');
        var header = $('.g-header_i');
        var header_w = $('header');
        var main = $('.main');
        if (modal.length && header_w.length && header.length && !main.length) {
            modal.on('show.bs.modal', function () {
                if (header_w.hasClass('min')) {
                    header.css('margin-right', window.innerWidth - document.body.clientWidth);
                }
            });
            modal.on('hide.bs.modal', function () {
                if ($('.menu-base').css('display') === 'block') {
                    setTimeout(function () {
                        $('body').css('padding-right', widthScrollBar());
                    }, 1);
                }
                header.css('margin-right', '');
            });
        }
    }

    //menu-base show
    function showMainMenu() {
        var btnOpen = $('#baseMenuShow');
        var mainMenu = $('.menu-base');
        if (!btnOpen.length || !mainMenu.length) {
            return false;
        }
        var body = $('body');
        var btnClose = $('#baseMenuHide');
        var header = $('.g-header');
        if (getInnerWidth() >= ws.const.screen.screen_md_min) {
            btnOpen.off('click.showMainMenu').on('click.showMainMenu', function () {
                var hBody = $(document).outerHeight();
                var hElement = $(window).outerHeight(true);
                if (hBody !== hElement) {
                    var scrollWidth = widthScrollBar();
                    body.css({
                        'padding-right': scrollWidth,
                        'overflow': 'hidden'
                    });
                    if (header.css('position') === 'fixed') {
                        header.css({
                            'padding-right': scrollWidth
                        });
                    }
                }
                mainMenu.fadeIn(200);
                setTimeout(function () {
                    mainMenu.find('select').trigger('refresh');
                }, 1);
            });
            btnClose.off('click.showMainMenu').on('click.showMainMenu', function () {
                mainMenu.fadeOut(200);
                setTimeout(function () {
                    body.css({
                        'padding-right': '',
                        'overflow': ''
                    });
                    header.css({
                        'padding-right': ''
                    });
                }, 200);
            });
        } else {
            mainMenu.fadeOut(200);
            body.css({
                'padding-right': '',
                'overflow': ''
            });
        }
    }

    //сортировка пунктов меню каталога в menu-base
    var menuDropBase = {

        timer: {},

        getMenuHeight: function () {
            var minHeight = 9999;
            var menuName;
            for (var key in menuDropBase.menus) {
                if (!menuDropBase.menus.hasOwnProperty(key)) {
                    return false;
                }
                var elementHeight = menuDropBase.menus[key].outerHeight();
                if (minHeight > elementHeight) {
                    minHeight = elementHeight;
                    menuName = key;
                }
            }
            return menuName;
        },

        sortMenu: function () {
            this.body = $('body');
            this.body.addClass('menuDropBase-init');
            this.menus = {};
            this.menus.menu1 = this.menu.find('.js-menu');
            this.columns = Math.round(this.menus.menu1.closest('.menu-drop-base').outerWidth() / this.menus.menu1.outerWidth());
            this.items.detach();
            this.menus.menu1.siblings('.menu_level_1').remove();
            for (var i = 2; i <= menuDropBase.columns; i++) {
                this.menus['menu' + i] = $('<ul class="break-word list-reset menu_level_1"></ul>').appendTo(this.menus.menu1.parent());
            }
            this.items.each(function () {
                menuDropBase.menus[menuDropBase.getMenuHeight()].append(this);
            });
            this.body.removeClass('menuDropBase-init');
        },

        setHandlers: function() {
            this.window.on('load', function () {
                menuDropBase.sortMenu();
            });
        },

        init: function () {
            this.window = $(window);
            menuDropBase.menu = $('.menu-drop-base');
            if (!menuDropBase.menu.length) {
                return false;
            }
            menuDropBase.items = menuDropBase.menu.find('.js-item');
            menuDropBase.sortMenu();
            menuDropBase.setHandlers();
        }
    };

    $(function () {
        menuDropBase.init();
        modalHeader();
    });
    oWindow.on('load', function () {
        showMainMenu();
    });
    oWindow.on('resize', function () {
        showMainMenu();
    });
}();