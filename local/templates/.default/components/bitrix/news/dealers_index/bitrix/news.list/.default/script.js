'use strict';

var WS_MAP = WS_MAP || {};

WS_MAP.table = {
    /**
     * @module table Модуль выбора города
     */

    /**
     * Скрываем итемы, точки которых не видны на карте
     */
    checkTableItems: function() {
        var app = this;
        this.mediator._selector.tableTr.each(function() {
            var self = $(this);
            var isVisible = false;
            if (app.mediator._data.filter.cbStatus.all === true) {
                self.show();
            } else {
                for (var it in app.mediator._data.points) {
                    if (app.mediator._data.points.hasOwnProperty(it)) {
                        if (self.data('id').toString() === it) {
                            isVisible = true;
                        }
                    }
                }
                if (isVisible === true) {
                    self.show();
                } else {
                    self.hide();
                }
            }
        });
    },

    /**
     * Удаляем карты у всех итемов
     */
    destroyItemsMap: function() {
        var app = this;
        if (this.mediator._data.list.length > 0) {
            this.mediator._data.list.map(function(item, i) {
                app.destroyItemMap(i);
            });
        }
    },

    /**
     * Перегенерить точки на карте
     */
    reinitPoints: function() {
        this.destroyItemsMap();
        this.checkTableItems();
    },

    /**
     *  Добавляем точку на карту
     * @param {Number} i номер итерации
     *  @param {Object} item параметры точки
     */
    addPoint: function(i, item) {
        var width = parseInt(WS_MAP.param.MAPS_ICON_MAIN_WIDTH);
        var height = parseInt(WS_MAP.param.MAPS_ICON_MAIN_HEIGHT);
        var marker = item.marker;
        if (marker === null) {
            marker = WS_MAP.param.MAPS_ICON_SRC;
        }
        var placemark = new ymaps.Placemark(
            [item.lat, item.lon],
            {
                hintContent: '',
                clusterCaption: item.name,
                balloonContentHeader: '<div class="name h4 mt_0">' + item.name + '</div>',
                balloonContentBody: '<div class="address mt_0">' + item.address + '</div>'
            },
            {
                iconLayout: 'default#image',
                iconImageHref: marker,
                iconImageSize: [width, height],
                iconImageOffset: [(width / -2), (height / -1)],
                hideIconOnBalloonOpen: false,
                balloonOffset: [0, (height / -1)]
            });

        this.mediator._data.list[i].map.geoObjects.add(placemark);
    },

    /**
     * Отключаем некоторые элементы управления на моб устройствах
     * @param {Number} i номер итерации
     */
    disableMobFunctions: function(i) {

        // Отключаем на моб устройствах пролистывание карты одним пальцем
        var isMobile = {
            Android: function() {return navigator.userAgent.match(/Android/i);},
            BlackBerry: function() {return navigator.userAgent.match(/BlackBerry/i);},
            iOS: function() {return navigator.userAgent.match(/iPhone|iPad|iPod/i);},
            Opera: function() {return navigator.userAgent.match(/Opera Mini/i);},
            Windows: function() {return navigator.userAgent.match(/IEMobile/i);},
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };

        // после вызова карты
        if (isMobile.any()){
            this.mediator._data.list[i].map.behaviors.disable('scrollZoom');
            this.mediator._data.list[i].map.behaviors.disable('drag');
        }
    },

    /**
     * Удаляем карту у итема
     * @param {Number} i номер итерации
     */
    destroyItemMap: function(i) {
        this.mediator._data.list[i].map.destroy();
        this.mediator._data.list[i].mapTr.remove();
        delete this.mediator._data.list[i];
        this.window.off('resize.' + this.mediator._const.nameSpace + i);
    },

    /**
     * На ресайзе подстраиваем карту или удаляем
     * @param {Number} i номер итерации
     */
    bindResize: function(i) {
        var app = this;
        this.mediator._data.list[i].timer = null;
        this.window.off('resize.' + app.mediator._const.nameSpace + i).on('resize.' + app.mediator._const.nameSpace + i, function() {
            clearTimeout(app.mediator._data.list[i].timer);
            app.mediator._data.list[i].timer = setTimeout(function() {
                if (app.mediator._data.list[i].mapTr.hasClass('active')) {
                    app.mediator._data.list[i].mapTr.find('#test' + i).css({
                        'width': app.mediator._selector.app.find('.dealers-table').outerWidth()
                    });
                    app.mediator._data.list[i].map.container.fitToViewport();
                } else {
                    app.destroyItemMap(i);
                }
            }, 300);
        });
    },

    /**
     * Инит карты
     * @param {Number} i номер итерации
     * @param {Number} id в списке точек
     */
    initMap: function(i, id) {
        var app = this;
        this.mediator._data.list[i].map = new ymaps.Map('test' + i, {
            center: [app.mediator._data.points[id].lat, app.mediator._data.points[id].lon],
            zoom: 16,
            type: 'yandex#map',
            controls: [// https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/controls-docpage/#controls__map-constructor
            ],
            margin: 50
        });
        // ToDo (2) Пересчитываем позицию карты с учетом margin. При ините не bounds не учитывает margin
        app.mediator._data.map.setBounds(ymaps.util.bounds.fromPoints(app.mediator._data.arrPointsCoord),
            {
                useMapMargin: true
            });
    },

    /**
     * Старт работы карты
     * @param {Number} i номер итерации
     * @param {Number} id в списке точек
     */
    startMap: function (i, id) {
        var app = this;
        this.mediator.cl('startMap');

        ymaps.ready(function init() {
            app.initMap(i, id);
            app.bindResize(i);
            app.addPoint(i, app.mediator._data.points[id]);
            app.disableMobFunctions(i);
        });
    },

    /**
     * Бинд клика для показа ссылки
     */
    bindClick: function () {
        var app = this;
        this.mediator.cl('bindClick');

        this.mediator._data.list = [];
        this.mediator._selector.tableLinks.each(function (i) {
            var self = $(this);
            self.on('click', function (e) {
                e.preventDefault();
                app.mediator._data.list.map(function(item) {
                    if (i !== item.i) {
                        item.mapTr.removeClass('active').find('#test' + item.i).slideUp();
                    }
                });
                if (app.mediator._data.list[i] !== undefined) {
                    if (app.mediator._data.list[i].mapTr.hasClass('active')) {
                        app.mediator._data.list[i].mapTr.removeClass('active').find('#test' + i).slideUp();
                        self.parents('tr').removeClass('active');
                    } else {
                        app.mediator._data.list[i].mapTr.addClass('active').find('#test' + i).slideDown();
                        self.parents('tr').addClass('active');
                    }
                } else {
                    app.mediator._data.list[i] = {};
                    app.mediator._data.list[i].i = i;
                    app.mediator._data.list[i].mapTr = $('<tr class="map active-map active"><td colspan="3"><div id="test' + i + '" class="dealers-table__map" style="height: 0;"></div></td></tr>').insertAfter(self.parents('tr'));
                    app.mediator._data.list[i].mapTr.find('#test' + i).animate({
                        'height': parseInt(WS_MAP.param.MAP_HEIGHT)
                    }, 300, function() {
                        self.parents('tr').addClass('active');
                        app.startMap(i, self.data('id'));
                    });
                }
            });
        });
    },

    /**
     * Инициализация параметров модуля
     */
    initParams: function () {
        this.mediator._selector.tableLinks = this.mediator._selector.app.find('.dealers-table .show-map .lnk-pseudo');
        this.mediator._selector.tableTr = this.mediator._selector.app.find('.dealers-table tr');
        this.window = $(window);
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