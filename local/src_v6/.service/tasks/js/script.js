'use strict';

module.exports = function (opt) {

    // Собираем в строку динамические скрипты из компонентов
    opt.gulp.task('script:getArr', function () {
        opt.jsCompiled = true;
        opt.script = opt.getDynamicString(opt.name.js);
        opt.scriptPaths = opt.getModulesFiles(opt.name.js);
        opt.scriptPaths.push('./js/app.js');
    });

    // Проверяем JS на наличие ошибок и если они имеются, выводим в консоль их список
    opt.gulp.task('script:linting', ['script:getArr'], function () {
        return opt.gulp.src(opt.scriptPaths)
            .pipe(opt.load.plumber())
            .pipe(opt.load.eslint())
            .pipe(opt.load.eslint.format())
            .pipe(opt.load.eslint.result(function (result) {
                if (result.warningCount > 0 || result.errorCount > 0) {
                    opt.jsCompiled = false; // Если имеются ошибки или предупрждения
                }
            }));
    });

    // Компиляция JS
    opt.gulp.task('script:compile', ['script:linting'], opt.task.scriptCompile = function () {
        if (opt.jsCompiled === true) { // Если нет ошибок или предупреждений компилируем
            return opt.gulp.src('./js/app.js')
                .pipe(opt.load.plumber())
                .pipe(opt.load.insert.append(opt.script))// Добавляем в конец файла строки
                .pipe(opt.load.data(function (file) { // Узнаём размер оригинального JS
                    opt.originalJS = 'app.js: ' + opt.makeBytesReadable(Buffer.byteLength(file.contents, opt.encoding));
                    return file;
                }))
                .pipe(opt.load.changed(opt.DIR + '/js/*.js'))
                .pipe(opt.load.preprocess())
                .pipe(opt.load.babel({
                    presets: ['env'],
                    plugins: ['transform-es2015-modules-strip', 'transform-object-rest-spread'],
                    compact: false
                }))
                .pipe(opt.load.uglify())
                .pipe(opt.load.header(opt.banner, {pkg: opt.pkg}))
                .pipe(opt.load.rename({suffix: '.min'}))
                .on('error', opt.load.util.log)
                .pipe(opt.load.data(function (file) { // Узнаём размер минифицированного JS
                    opt.minifiedJS = 'app.min.js: ' + opt.makeBytesReadable(Buffer.byteLength(file.contents, opt.encoding));
                    return file;
                }))
                .pipe(opt.gulp.dest(opt.DIR + '/js'));
        }
    });

    // Пересобираем JS при изменении
    opt.gulp.task('script-sync', ['script:compile'], function () {
        opt.showJsCompileStatus();
        opt.reload();
    });

    // Вотчеры JS файлов
    opt.gulp.task('script:watch', ['script:compile'], function () {
        opt.scriptFiles = opt.getModulesFiles(opt.name.js);
        opt.gulp.watch(['./js/*.js', './js/bootstrap/**/*.js', opt.scriptFiles], ['script-sync']);
        opt.gulp.watch('./js/libs/**/*.js', ['script-libs-sync']);
    });

    // Общая задача по сборке app.min.js
    opt.gulp.task('script', ['script:watch']);
};