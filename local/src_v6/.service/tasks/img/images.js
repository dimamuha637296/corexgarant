'use strict';

module.exports = function (opt) {

    /**
     * Меняем в svg всех вхождения #{$НАЗВАНИЕ_ПЕРЕМЕННОЙ} на значение переменной из core/base_styles/grid/style.scss
     *
     * @param {string} svg - содержимое svg файла
     */
    function insertSassVars(svg) {
        var sassVarRegExp = /\#\{(\$[^\}\s]*)\}/g; //https://www.regextester.com/?fam=106742
        return svg.replace(sassVarRegExp, function (str, varName) {
            return opt.sassVars[varName];
        });
    }

    // Очищаем папку с картинками
    opt.gulp.task('images:del', function () {
        return opt.del([
            opt.DIR + '/img/*.svg',
            opt.DIR + '/img/*.png',
            opt.DIR + '/img/*.jpg',
            opt.DIR + '/img/tmp',
            opt.DIR + '/img/cursor'
        ], {force: true});
    });

    // Собираем пути картинок из модулей в массив
    opt.gulp.task('images:getImgArr', ['images:del'], opt.task.getImgArr = function () {
        // массив путей картинок из компонентов images
        opt.arrImages = opt.getImgArrPath('img');
    });

    // Если на прошлых этапах сборки был создан png-спрайт, помещаем его в папку img
    opt.gulp.task('images:sprite', opt.task.imgSprite = function (done) {
        if (opt.pngSprite !== undefined) {
            return opt.pngSprite
                .pipe(opt.buffer())
                .pipe(opt.load.imagemin())
                .pipe(opt.gulp.dest(opt.DIR + '/img'));
        } else {
            done();
        }
    });

    // Минимизируем и копируем картинки из images
    opt.gulp.task('images:mini', ['images:getImgArr', 'images:sprite'], opt.task.imgMini = function () {
        return opt.gulp.src(opt.arrImages)
            .pipe(opt.load.plumber())
            .pipe(opt.load.imagemin([
                opt.load.imagemin.gifsicle(),
                // https://www.npmjs.com/package/imagemin-mozjpeg#quality
                opt.imageminMozjpeg({
                    dcScanOpt: 2,
                    quality: 85 // default: 79
                }),
                opt.load.imagemin.optipng(),
                opt.load.imagemin.svgo()
            ], {
                progressive: true
            }))
            .on('error', opt.load.util.log)
            .pipe(opt.gulp.dest(function (file) {
                // Если изображение имеет расширение SVG ищем в нём SCSS переменные и меняем их на значения из variables.scss
                if (file.path.endsWith('.svg') === true) {
                    file.contents = Buffer.from(insertSassVars(String(file.contents)));
                }
                return opt.DIR + '/img';
            }));
    });

    // Пересобираем изображения при изменении
    opt.gulp.task('images-sync', ['images:mini'], opt.reload);

    // Вотчер изображений
    opt.gulp.task('images:watch', ['images:mini'], function () {
        opt.gulp.watch(opt.arrImages, ['images-sync']);
    });

    // Общая задача по сборке картинок
    opt.gulp.task('images', ['images:watch']);
};