!function () {
    'use strict';

    var slTable = {

        // инициализирует слайдер для построенной таблицы
        initSlider: function () {
            this.slider = this.block.find('.table__slider');
            var wrap = this.block.find('.table__slider-wrap');
            var pager = this.block.find('.table__pager');
            wrap.removeClass('inited-not');
            this.slider.carouFredSel({
                width: '100%',
                height: 'auto',
                auto: false,
                pagination: pager,
                responsive: true,
                scroll: {
                    duration: 300,
                    items: 1,
                    timeoutDuration: 7000,
                    pauseOnHover: true
                },
                swipe: {
                    onMouse: true,
                    onTouch: true,
                    excludedElements: 'button, input, select, textarea, .noSwipe, .btn'
                }
            });
            if (this.block.find('.help').length) {
                this.block.find('.help').each(function () {
                    $(this).reInitPopover();
                });
            }
        },

        // парсит таблицу и строит на её основе таблицу на дивах
        createMobTable: function(currTable) {
            this.th = currTable.find('th');
            this.slideLength = this.th.length - 1; // кол-во слайдов
            var html = '';

            html += '<div class="table__slider-wrap cursor inited-not">';

            html += '<div class="table__slider">';

            for (var slideIndex = 0; slideIndex < this.slideLength; slideIndex++) {

                html += '<div class="table__slide">';

                html += '<div class="table__h-title">' + this.th.eq(slideIndex + 1).html() + '</div>';

                this.tr = currTable.find('tbody tr');
                this.rowLength = this.tr.length;

                for (var rowIndex = 0; rowIndex < this.rowLength; rowIndex++) {
                    this.currentRow = $(this.tr[rowIndex]);
                    this.td = this.currentRow.find('td');

                    html += '<div class="table__row">';

                    html += '<div class="table__cell table__cell--bold">' + this.td.eq(0).html() + '</div>';
                    html += '<div class="table__cell">' + this.td.eq(slideIndex + 1).html() + '</div>';

                    html += '</div>';

                }

                html += '</div>';

            }

            html += '</div>';

            html += '<div class="table__pager"></div>';

            html += '</div>';
            this.mobTable = $('<div class="table__mob-table">' + html + '</div>');
            this.mobTable.appendTo(currTable);
            this.window.off('resize.tableSlider4');
        },

        startSlider: function () {
            if ($.fn.carouFredSel && getInnerWidth() < ws.const.screen.screen_sm_max) {
                this.block.each(function () {
                    var currTable = $(this);
                    slTable.createMobTable(currTable);
                });
                this.initSlider();
            }
        },

        setResizeHandler: function () {
            this.window.on('resize.tableSlider4', function() {
                clearTimeout(slTable.timer);
                slTable.timer = setTimeout(function() {
                    slTable.startSlider();
                }, 200);
            });
        },

        init: function () {
            this.block = $('.sl_table');
            if (!this.block.length) {
                return false;
            }
            this.window = $(window);
            this.timer = null;
            this.setResizeHandler();
            this.startSlider();
        }
    };

    // Вызываем только на DOMReady, потому что остальные обработчики навешиваются при инициализации слайдера
    $(function () {
        slTable.init();
    });
}();