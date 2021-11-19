'use strict';

var WS_MAP = WS_MAP || {};

WS_MAP.Mediator = {
    /**
     * @module Mediator Модуль посредника
     */

    /**
     * Перегенерить точки на карте
     */
    reinitPoints: function() {
        WS_MAP.Mediator.cl('reinitPoints');
        WS_MAP.main.callSaveMethod('map.reinitPoints');
        WS_MAP.main.callSaveMethod('table.reinitPoints');
        WS_MAP.Mediator.cl(WS_MAP);
    },

    /**
     * Фильтрация точек по фильтрам categoryFilter
     * @param {Function} cb коллбэк если функция не существует
     */
    filterPoints: function(cb) {
        WS_MAP.Mediator.cl('filterPoints');
        if (WS_MAP.main.hasMethod('categoryFilter.filterPoints')) {
            WS_MAP.main.callSaveMethod('categoryFilter.filterPoints');
        } else if (cb !== undefined) {
            cb();
        }
    },

    /**
     * Старт приложения
     */
    startApp: function() {
        WS_MAP.Mediator.cl('startApp');
        WS_MAP.main.callSaveMethod('cityFilter.bindSelectChange');
        WS_MAP.main.callSaveMethod('map.startMap');
        WS_MAP.main.callSaveMethod('table.bindClick');
        WS_MAP.main.callSaveMethod('categoryFilter.bindChange');
    },

    cl: function(str) {
        if (this._const.debug === true || this._const.urlDebug === true) {
            console.log(str);
        }
    },

    initParams: function () {
        this._selector = {};
        this._const = {};
        this._data = {};

        this._const.nameSpace = 'WS_MAP';// Имя приложения
        this._const.debug = false;// режим дебага
        this._const.urlDebug = window.location.search.replace( '?', '').indexOf('debug=true') > -1;// режим дебага в урл страницы
        this._selector.app = WS_MAP.main.block;
    },

    init: function () {
        this.initParams();
    }
};

WS_MAP.main = {
    /**
     * @module Main запуск приложения, инит настроек
     */

    /**
     * Проверка, существует ли метод
     * @param {String} item имя модуля. имя метода
     */
    hasMethod: function (item) {
        var ar = item.split('.');
        var module = ar[0];
        if (WS_MAP[module] !== undefined) {
            var method = ar[1];
            if (typeof WS_MAP[module][method] === 'function') {
                return true;
            }
        }
        return false;
    },

    /**
     * Безопасный вызов методов из другого объекта
     * @param {String} item имя модуля. имя метода
     */
    callSaveMethod: function (item) {
        var ar = item.split('.');
        var module = ar[0];
        if (WS_MAP[module] !== undefined) {
            var method = ar[1];
            if (typeof WS_MAP[module][method] === 'function') {
                WS_MAP[module][method]();
            }
        }
    },

    mediator: WS_MAP.Mediator,

    /**
     * Инит приложения
     * @method init
     */
    init: function () {
        this.block = $('#ws_map');
        if (!this.block.length) {
            return false;
        }

        // Init Modules
        this.callSaveMethod('Mediator.init');
        this.callSaveMethod('cityFilter.init');
        this.callSaveMethod('map.init');
        this.callSaveMethod('table.init');
        this.callSaveMethod('categoryFilter.init');

        // Call Modules
        this.mediator.startApp();

        WS_MAP.Mediator.cl('WS_MAP:');
        WS_MAP.Mediator.cl(WS_MAP);
        WS_MAP.Mediator.cl('this.mediator:');
        WS_MAP.Mediator.cl(this.mediator);
    }
};

$(function () {
    WS_MAP.main.init();
});