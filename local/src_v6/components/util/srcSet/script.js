!function () {
    'use strict';

    /**
     * @class SrcSet Установка src под разные разрешения экрана
     */
    var SrcSet = {

        /**
         * Установить Src
         * @method setSrc
         * @param {jQuery} $item - элемент которому меняем src
         */
        setSrc: function ($item) {
            var src = null;
            var windowWidth = getInnerWidth();

            if (windowWidth >= ws.const.screen.screen_xl_min && $item.data(this.const.dataXlName)) {
                src = $item.data(this.const.dataXlName);
            } else if (windowWidth >= ws.const.screen.screen_lg_min && $item.data(this.const.dataLgName)) {
                src = $item.data(this.const.dataLgName);
            } else if (windowWidth >= ws.const.screen.screen_md_min && $item.data(this.const.dataMdName)) {
                src = $item.data(this.const.dataMdName);
            } else if (windowWidth >= ws.const.screen.screen_sm_min && $item.data(this.const.dataSmName)) {
                src = $item.data(this.const.dataSmName);
            } else if ($item.data(this.const.dataXsName)) {
                src = $item.data(this.const.dataXsName);
            }

            if (src !== undefined && src !== null) {
                $item.attr('src', src);
            }
        },

        /**
         * Изменить src у всех элементов
         * @method changeSrc
         */
        changeSrc: function () {
            var app = this;
            this.block.each(function () {
                app.setSrc($(this));
            });
        },

        /**
         * Привязать обработчики
         * @method bindHandlers
         */
        bindHandlers: function () {
            var app = this;
            this.window.off('resize.srcSet').on('resize.srcSet', function () {
                app.changeSrc();
            });
        },

        /**
         * Инициализация
         * @method init
         */
        init: function () {
            if (Modernizr.srcset === false) {
                this.block = $('.js-srcset');
                this.window = $(window);
                this.const = {
                    dataXsName: 'src-xs',
                    dataSmName: 'src-sm',
                    dataMdName: 'src-md',
                    dataLgName: 'src-lg',
                    dataXlName: 'src-xl'
                };
                if (!this.block.length) {
                    return false;
                }
                this.bindHandlers();
                this.changeSrc();
            }
        }
    };

    $(function () {
        SrcSet.init();
    });
}();