!function () {
    'use strict';
    var cookies = {

        // работа с Cookie
        // https://learn.javascript.ru/cookie
        /**
         * Устанавливает cookie с именем name и значением value
         *
         * @param name - имя cookie
         * @param value - значение cookie
         * @param options - объект опций
         * @param options.expires - Время истечения cookie. Интерпретируется по-разному, в зависимости от типа:
         * Число – количество секунд до истечения. Например, expires: 3600 – cookie на час.
         * Объект типа Date – дата истечения.
         * Если expires в прошлом, то cookie будет удалено.
         * Если expires отсутствует или 0, то cookie будет установлено как сессионное и исчезнет при закрытии браузера.
         * @param options.path - Путь для cookie
         * @param options.domain - Домен для cookie
         * @param options.secure - Если true, то пересылать cookie только по защищенному соединению
         */
        setCookie: function (name, value, options) {
            options = options || {};
            var expires = options.expires;
            if (typeof expires == 'number' && expires) {
                var d = new Date();
                d.setTime(d.getTime() + expires * 1000);
                expires = options.expires = d;
            }
            if (expires && expires.toUTCString) {
                options.expires = expires.toUTCString();
            }
            value = encodeURIComponent(value);
            var updatedCookie = name + "=" + value;
            for (var propName in options) {
                updatedCookie += "; " + propName;
                var propValue = options[propName];
                if (propValue !== true) {
                    updatedCookie += "=" + propValue;
                }
            }
            document.cookie = updatedCookie;
        },

        /**
         * возвращает cookie с именем name, если есть, если нет, то undefined
         *
         * @param name
         * @returns string || undefined
         */
        getCookie: function (name) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        },

        init: function () {
            var app = this;
            this.block = $('.cookies');
            if (!this.block.length) {
                return false;
            }
            if (this.getCookie('showCookiesMsg') !== 'true') {
                this.block.show();
                setTimeout(function() {
                    app.block.addClass('active');
                    app.block.find('.cookies__btn').off('click.cookies').on('click.cookies', function(e) {
                        e.preventDefault();
                        app.setCookie('showCookiesMsg', true, {
                            expires: (3600 * 24 * 30 * 12),
                            domain: '.' + window.location.hostname,
                            path: '/'
                        });
                        app.block.removeClass('active');
                    });
                }, 300);
            }
        }
    };

    $(function () {
        cookies.init();
    });
}();