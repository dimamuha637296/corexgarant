!function () {
    'use strict';

    function VideoWrap() {}

    VideoWrap.prototype.setPauseHandler = function () {
        var app = this;
        this.close.on('click', function () {
            // ставим на паузу
            app.video[0].pause();
            // убираем контролы
            app.video.removeAttr('controls');
            app.wrap.removeClass('active');
            app.link.show();
            app.close.hide();
        });
    };

    VideoWrap.prototype.setPlayHandler = function () {
        var app = this;
        this.link.on('click', function () {
            // прячем плей
            app.link.hide();
            // убираем затемнение
            app.wrap.addClass('active');
            setTimeout(function () {
                // включаем контролы
                app.video.attr('controls', 'controls');
                // запускаем плей
                app.video[0].play();
                // показываем кнопку закрытия
                app.close.show();
            }, 0);
            return false;
        });
    };

    VideoWrap.prototype.init = function (block) {
        this.block = block;
        this.wrap = this.block.find('.wrap');
        this.link = this.block.find('.link');
        if (!this.link.length) {
            return false;
        }
        this.video = this.block.find('.video');
        this.close = this.block.find('.close-link-video');
        this.setPlayHandler();
        this.setPauseHandler();
    };

    function initVideoWrap() {
        var video = $('.video-wrap');
        if (video.length) {
            video.each(function () {
                (new VideoWrap().init($(this)));
            });
        }
    }

    $(function () {
        initVideoWrap();
    });
}();