'use strict';

module.exports = function (opt) {

    // Собираем пути картинок из модулей в массив
    opt.gulp.task('png:getImgArr', function () {
        // массив путей картинок из компонентов - png
        opt.arrPng = opt.getSvgArrPath('png');
    });

    // Собираем картинки в спрайт
    opt.gulp.task('png:create', ['png:getImgArr'], opt.task.pngCreate = function () {
        if (opt.arrPng.length) {
            var pngData = opt.gulp.src(opt.arrPng)
                .pipe(opt.load.spritesmith({
                    /*retinaSrcFilter: ['./*@2x.png'],
                    retinaImgName: 'sprite@2x.png',*/
                    imgName: 'sprite.png',
                    cssFormat: 'scss',
                    cssName: 'style.scss',
                    algorithm: 'binary-tree',
                    cssTemplate: './core/util/png/png.mustache',
                    padding: 2,
                    cssVarMap: function (sprite) {
                        sprite.name = 'png-' + sprite.name;
                    }
                }));

            opt.pngSprite = pngData.img; // записываем stream для изображения спрайта в глобальную переменную, чтобы вызывать в таске images
            pngData.css.pipe(opt.gulp.dest('./core/util/png/')); // путь, куда сохраняем стили

            return pngData;
        } else {
            // Если нет ни одного спрайта, пишем пустой scss
            opt.fs.writeFileSync('./core/util/png/style.scss', '');
            // Файл пустого спрайта удаляет другая задача
        }
    });

    // Пересобираем спрайт при изменении
    opt.gulp.task('png-sync', ['png:create']);// Не релоадим, изменится SASS файл, на нем сработает релоад

    // Вотчер изображений спрайта
    opt.gulp.task('png:watch', ['png:create'], function () {
        opt.gulp.watch(opt.arrPng, function () {
            opt.load.sequence('png-sync', 'images:sprite')();
        });
    });

    // Общая задача по сборке спрайта
    opt.gulp.task('png', ['png:watch']);
};