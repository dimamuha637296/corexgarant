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
        this.bindSelect('selectCountry');
        this.bindSelect('selectCity');
    },

    /**
     * Инициализация параметров модуля
     */
    initParams: function () {
        this.mediator._selector.selectCountry = this.mediator._selector.app.find('select#form-COUNTRY');
        this.mediator._selector.selectCity = this.mediator._selector.app.find('select#form-CITY');
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