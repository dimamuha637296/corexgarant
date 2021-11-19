'use strict';

var WS_MAP = WS_MAP || {};

WS_MAP.cityFilter = {
    /**
     * @module cityFilter Модуль выбора города
     */

    /**
     * Бинд одного селекта
     * @param select имя селектора
     */
    bindSelect: function(select) {
        this.mediator.cl('bindSelect ' + select);
        var app = this;
        this.mediator._selector[select]
            .off('change.' + this.mediator._const.nameSpace)
            .on('change.' + this.mediator._const.nameSpace, function() {
                if (app.mediator._selector[select].find('option:selected').length > 0) {
                    window.location.href= $(this).val();
                }
            });
    },

    /**
     * Бинд изменения селектов
     */
    bindSelectChange: function () {
        this.mediator.cl('bindSelectChange');
        if (this.mediator._selector.selectCountry.length) {
            this.bindSelect('selectCountry');
        }
        if (this.mediator._selector.selectCity.length) {
            this.bindSelect('selectCity');
        }
    },

    /**
     * Инициализация параметров модуля
     */
    initParams: function () {
        this.mediator._selector.selectCountry = this.mediator.createSelector('select#form-COUNTRY');
        this.mediator._selector.selectCity = this.mediator.createSelector('select#form-CITY');
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