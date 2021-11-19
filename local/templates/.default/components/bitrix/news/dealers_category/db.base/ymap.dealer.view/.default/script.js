'use strict';

var WS_MAP = WS_MAP || {};

WS_MAP.map = {
    /**
     * @module map Модуль карты
     */

    /**
     * Создаем массив координат из точек
     */
    createPointsCoordsAr: function() {
        this.mediator._data.arrPointsCoord = [];
        for (var item in this.mediator._data.points) {
            if (this.mediator._data.points.hasOwnProperty(item)) {
                if (this.mediator._data.points[item].lat !== undefined && this.mediator._data.points[item].lon !== undefined) {
                    this.mediator._data.arrPointsCoord.push([this.mediator._data.points[item].lat, this.mediator._data.points[item].lon]);
                }
            }
        }
    },

    /**
     * Добавляет кластеризацию на карту
     */
    addClusterer: function() {
        if (this.mediator._data.geoObjects.length > 1) {
            var width = parseInt(WS_MAP.param.MAPS_ICON_CLUSTER_WIDTH);
            var height = parseInt(WS_MAP.param.MAPS_ICON_CLUSTER_HEIGHT);
            var widthBig = parseInt(WS_MAP.param.MAPS_ICON_CLUSTER_BIG_WIDTH);
            var heightBig = parseInt(WS_MAP.param.MAPS_ICON_CLUSTER_BIG_HEIGHT);
            this.mediator._data.clusterer = new ymaps.Clusterer(
                {
                    // https://tech.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Clusterer-docpage/#Clusterer__param-options.gridSize
                    gridSize: 100,
                    // Зададим массив, описывающий иконки кластеров разного размера.
                    clusterIcons: [
                        {
                            href: WS_MAP.param.MAPS_ICON_CLUSTER_SRC,
                            size: [width, height],
                            offset: [(width / -2), (height / -2)]
                        },
                        {
                            href: WS_MAP.param.MAPS_ICON_CLUSTER_BIG_SRC,
                            size: [widthBig, heightBig],
                            offset: [(widthBig / -2), (heightBig / -2)]
                        }
                    ],
                    // Эта опция отвечает за размеры кластеров.
                    // В данном случае для кластеров, содержащих до 100 элементов,
                    // будет показываться маленькая иконка. Для остальных - большая.
                    clusterNumbers: [100],
                    clusterIconContentLayout: ymaps.templateLayoutFactory.createClass(
                        '<div class="db-ymaps-cluster-text">$[properties.geoObjects.length]</div>'
                    )
                }
            );

            this.mediator._data.clusterer.add(this.mediator._data.geoObjects);
            this.mediator._data.map.geoObjects.add(this.mediator._data.clusterer);
        }
    },

    /**
     *  Добавляем точку на карту
     *  @param {Object} item параметры точки
     */
    addPoint: function(item) {
        if (item.lat !== undefined && item.lon !== undefined) {
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

            this.mediator._data.map.geoObjects.add(placemark);
            this.mediator._data.geoObjects.push(placemark);
        }
    },

    /**
     * Добавляем точки на карту
     */
    addPoints: function() {
        var app = this;
        if (this.mediator._data.points !== undefined) {
            this.mediator._data.geoObjects = [];
            for (var item in this.mediator._data.points) {
                if (this.mediator._data.points.hasOwnProperty(item)) {
                    app.addPoint(this.mediator._data.points[item]);
                }
            }
        }
    },

    /**
     * Отключаем некоторые элементы управления на моб устройствах
     */
    disableMobFunctions: function() {

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
            this.mediator._data.map.behaviors.disable('scrollZoom');
            this.mediator._data.map.behaviors.disable('drag');
        }
    },

    /**
     * Проверяем макс зум, чтоб карта при ините не была слишком близко
     */
    checkMaxZoom: function() {
        if (this.mediator._data.map.getZoom() > 13) {
            this.mediator._data.map.setZoom(13);
        }
    },

    /**
     * Инит карты
     */
    initMap: function() {
        var app = this;
        this.mediator._data.map = new ymaps.Map('map', {// https://tech.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Map-docpage/
            bounds: ymaps.util.bounds.fromPoints(app.mediator._data.arrPointsCoord),// https://tech.yandex.ru/maps/doc/jsapi/2.1/ref/reference/util.bounds-docpage/
            type: 'yandex#map',
            controls: [// https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/controls-docpage/#controls__map-constructor
                'geolocationControl', // Геолокация
                'zoomControl', // Ползунок масштаба
                'rulerControl' // Линейка
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
     * Проверяем, есть ли в боундсе хоть одни координаты
     * @param {Function} cb коллбэк если карта открывается
     */
    checkHasPoints: function(cb) {
        if (this.mediator._data.arrPointsCoord.length > 0) {
            this.mediator._selector.map.slideDown(400, function() {
                if (cb !== undefined) {
                    cb();
                }
            });
            this.mediator._selector.mapMsg.slideUp();
        } else {
            this.mediator._selector.map.slideUp();
            this.mediator._selector.mapMsg.slideDown();
        }
    },

    /**
     * Перегенерить точки на карте
     */
    reinitPoints: function() {
        var app = this;
        // Чистим все
        this.mediator._data.map.geoObjects.removeAll();
        this.mediator._data.geoObjects = [];
        if (this.mediator._data.clusterer !== undefined) {
            this.mediator._data.clusterer.removeAll();
        }

        this.mediator.filterPoints(function() {
            app.mediator._data.points = WS_MAP.points;
        });
        this.createPointsCoordsAr();
        this.checkHasPoints(function() {
            app.mediator._data.map.container.fitToViewport();
            app.mediator._data.map.setBounds(
                ymaps.util.bounds.fromPoints(app.mediator._data.arrPointsCoord),
                {
                    useMapMargin: true
                }
            );
            app.checkMaxZoom();
            app.addPoints();
            app.addClusterer();
        });
    },

    /**
     * Старт работы карты
     */
    startMap: function () {
        var app = this;
        this.mediator.cl('startMap');

        app.mediator.filterPoints(function() {
            app.mediator._data.points = WS_MAP.points;
        });
        this.createPointsCoordsAr();

        ymaps.ready(function init() {
            app.initMap();
            app.checkMaxZoom();
            app.checkHasPoints();
            app.addPoints();
            app.addClusterer();
            app.disableMobFunctions();
        });
    },

    /**
     * Инициализация параметров модуля
     */
    initParams: function () {
        this.mediator._selector.map = this.mediator._selector.app.find('#map');
        this.mediator._selector.mapMsg = this.mediator._selector.app.find('.map__msg');
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