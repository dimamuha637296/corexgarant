'use strict';

module.exports = function (opt) {

    opt.gulp.task('sass-libs:compile', function () {
        var libsPath = opt.cssLibs.concat(['./scss/libs/*.scss']);
        return opt.gulp.src(libsPath)
            .pipe(opt.load.plumber())
            .pipe(opt.load.sass({
                outputStyle: 'expanded'
            }).on('error', opt.load.sass.logError))
            .pipe(opt.load.inlineBase64({
                useRelativePath: true, // Испльзуем путь относительно стилей библиотки, чтобы не размещать картинки в /img, откуда они попадут в local/templates/.default/img где они не нужны
                maxSize: 20 * 1024, // Максимальный размер изображения в байтах (20 Кб)
                debug: false // Выкл. уведомления
            }))
            .pipe(opt.load.autoprefixer({
                browsers: [
                    // Deprecated https://getbootstrap.com/docs/4.3/getting-started/browsers-devices/
                    "last 1 major version",
                    ">= 2%",
                    "Chrome >= 70",
                    "Firefox >= 60",
                    "Edge >= 12",
                    "Explorer >= 11",
                    "iOS >= 10",
                    "Safari >= 10",
                    "Android >= 5.0",
                    "Opera >= 60"
                ],
                cascade: false
            }))
            .pipe(opt.load.cleanCss({
                advanced: false
            }))
            .pipe(opt.load.rename(function (path) {
                path.basename = path.basename.replace(opt.noAttachSuffix, '') + '.min';
            }))
            .on('error', opt.load.util.log)
            .pipe(opt.gulp.dest(opt.DIR + '/css/libs'));
    });

    opt.gulp.task('sass-libs-sync', ['sass-libs:compile'], opt.reload);

    opt.gulp.task('sass-libs:watch', ['sass-libs:compile'], function () {
        var libsPath = opt.cssLibs.concat(['./scss/libs/*.scss']);
        opt.gulp.watch(libsPath, function () {
            if (opt.scssWatchBlocked === false) {
                opt.load.sequence('sass-libs-sync')();
            }
        });
    });

    // Общая задача sass-libs
    opt.gulp.task('sass-libs', ['sass-libs:watch']);
};