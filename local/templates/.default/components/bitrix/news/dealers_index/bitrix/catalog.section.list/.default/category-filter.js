WS_MAP.categoryFilter = {
    /**
     * @module categoryFilter Модуль фильтра категорий
     */

    /**
     * Собираем активность чекбоксов
     */
    getItemsActivity: function() {
        var app = this;
        this.mediator._data.filter.cbStatus = {};
        this.mediator._data.filter.cbStatusTrue = [];
        this.mediator._data.filter.cbStatusFalse = [];
        this.mediator._selector.filter.items.each(function() {
            var self = $(this);
            var status = self.prop('checked');
            var val = self.val();
            app.mediator._data.filter.cbStatus[val] = status;
            if (status === true) {
                app.mediator._data.filter.cbStatusTrue.push(val);
            } else {
                app.mediator._data.filter.cbStatusFalse.push(val);
            }
        });
        if (this.mediator._data.filter.cbStatus.all === true) {
            this.mediator._selector.filter.itemAll.prop('disabled', true).button('refresh');
        } else {
            this.mediator._selector.filter.itemAll.prop('disabled', false).button('refresh');
        }
    },

    /**
     * Фильтруем точки по включенным категориям
     */
    filterPoints: function() {
        var app = this;
        if (this.mediator._data.filter.cbStatus.all === true) {
            this.mediator._data.points = WS_MAP.points;
        } else {
            this.mediator._data.points = {};
            for (var item in WS_MAP.points) {
                if (WS_MAP.points.hasOwnProperty(item)) {
                    app.mediator._data.filter.cbStatusTrue.map(function (item2) {
                        if (WS_MAP.points[item].filter_id === item2) {
                            app.mediator._data.points[item] = WS_MAP.points[item];
                        }
                    });
                }
            }
        }
    },

    /**
     * Бинд изменений чекбоксов фильтра
     */
    bindChange: function () {
        var app = this;
        this.mediator.cl('categoryFilter.bindChange');
        this.mediator._selector.filter.itemsSimple.off('change.' + this.mediator._const.nameSpace).on('change.' + this.mediator._const.nameSpace, function() {
            app.mediator._selector.filter.itemAll.prop('checked', false).button('refresh');
            app.getItemsActivity();
            if (app.mediator._data.filter.cbStatusTrue.length === 0) {
                if (app.mediator._data.filter.stopCbHand !== true) {
                    app.mediator._data.filter.stopCbHand = true;
                    app.mediator._selector.filter.itemAll.prop('checked', true).trigger('change');
                }
            } else {
                app.mediator.reinitPoints();
                app.mediator._data.filter.stopCbHand = false;
            }
        });
        this.mediator._selector.filter.itemAll.off('change.' + this.mediator._const.nameSpace).on('change.' + this.mediator._const.nameSpace, function() {
            if (app.mediator._data.filter.stopCbHand !== true) {
                app.mediator._selector.filter.itemsSimple.each(function(i, item) {
                    $(item).prop('checked', false).button('refresh');
                });
                app.mediator._data.filter.stopCbHand = false;
            }
            app.getItemsActivity();
            app.mediator.reinitPoints();
        });
    },

    /**
     * Инициализация параметров модуля
     */
    initParams: function () {
        this.mediator._data.filter = {};
        this.mediator._selector.filter = {};
        this.mediator._selector.filter.container = this.mediator.createSelector('.js-categories');
        this.mediator._selector.filter.items = this.mediator.createSelector('input.map_filter');
        this.mediator._selector.filter.itemAll = this.mediator.createSelector('input.map_filter--all');
        this.mediator._selector.filter.itemsSimple = this.mediator.createSelector('input.map_filter:not(.map_filter--all)');
        this.getItemsActivity();
    },

    /**
     * Импортируем посредника
     */
    mediator: WS_MAP.Mediator,

    /**
     * Инициализация модуля. Вызывается при инициализации приложения
     */
    init: function () {
        this.initParams();
    }
};