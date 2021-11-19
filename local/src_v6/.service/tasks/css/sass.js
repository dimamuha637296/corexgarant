'use strict';

module.exports = function (opt) {

    // Рекурсивное получение значения SCSS переменной
    function getScssVarValue(name) {
        var varNameRegexp = /(\$[^\s\:\;\.\,]*)/g; // https://www.regextester.com/?fam=106745
        var value = opt.sassVars[name];

        if (value !== undefined) {
            if (value.includes('$') === true) {
                return opt.sassVars[name].replace(varNameRegexp, function (originalStr, name) {
                    return getScssVarValue(name);
                });
            } else {
                return value;
            }
        } else {
            return '';
        }
    }

    // Блокируем вотчинг изменений scss
    opt.gulp.task('sass:block-watch', function (done) {
        opt.scssWatchBlocked = true;
        done();
    });

    // Разблокируем вотчинг изменений scss
    opt.gulp.task('sass:unblock-watch', function (done) {
        opt.scssWatchBlocked = false;
        done();
    });

    // Собираем scss перменные в объект opt.sassVars
    opt.gulp.task('sass:get-vars', function (done) {
        var varNameValueRegexp = /(\$.*?):(.*?);/g; // https://www.regextester.com/?fam=106743
        var file = opt.fs.readFileSync(opt.sassVarsPath, opt.encoding);
        var match = null;
        opt.sassVars = {};

        // Формируем объект scss переменных вида: "$ИМЯ_ПЕРЕМЕННОЙ": "ЗНАЧЕНИЕ"
        while ((match = varNameValueRegexp.exec(file)) !== null) {
            var name = match[1];
            opt.sassVars[name] = match[2].replace(/^\s*(.*)$/g, function (originalStr, withoutSpaces) {
                return withoutSpaces;
            });
        }

        // Проходим по полученном объекту и получаем значение для каждой переменной или удаляем её если её значение не может быть найдено (например, ссылается на неверную переменную)
        Object.keys(opt.sassVars).forEach(function (item) {
            var value = getScssVarValue(item);

            if (value !== '') {
                opt.sassVars[item] = value;
            } else {
                delete opt.sassVars[item];
            }
        });

        done();
    });

    // Собираем в строку стили компонентов и обрабатываем их
    opt.gulp.task('sass:create-string', function () {
        opt.styles = '';
        opt.stylesPathList = opt.getModulesFiles(opt.name.scss);
        return opt.gulp.src(opt.stylesPathList)
            .pipe(opt.load.inlineBase64({
                useRelativePath: true, // Испльзуем путь относительно style.scss, чтобы не размещать картинки в /img, откуда они попадут в local/templates/.default/img где они не нужны
                maxSize: 20 * 1024, // Максимальный размер изображения в байтах (20 Кб)
                debug: false // Выкл. уведомления
            }))
            .pipe(opt.load.data(function (file) {
                opt.styles += file.contents.toString() + '\n';
                return file;
            }));
    });

    // Компилируем SASS
    opt.gulp.task('sass:compile', ['sass:create-string'], opt.task.sassCompile = function () {
        return opt.gulp.src(opt.sass + 'app.scss')// Нельзя начинать с _
            .pipe(opt.load.plumber())
            .pipe(opt.load.insert.append('\n'))// Перенос чтоб первая строка из opt.styles не была внутри последней строки app.scss
            .pipe(opt.load.insert.append(opt.styles))// Добавляем в конец файла строки
            // .pipe(opt.gulp.dest(opt.DIR + '/debug'))
            .pipe(opt.load.sass({
                outputStyle: 'expanded'
            }).on('error', opt.load.sass.logError))
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
            .pipe(opt.load.mergeMediaQueries({
                log: true
            }))
            .pipe(opt.load.cleanCss({
                advanced: false
            }, function(details) {
                opt.originalCSS = 'app.css: ' + opt.makeBytesReadable(details.stats.originalSize);
                opt.minifiedCSS = 'app.min.css: ' + opt.makeBytesReadable(details.stats.minifiedSize);
            }))
            // .pipe(opt.gulp.dest(opt.DIR + '/debug'))
            .pipe(opt.load.rename({
                basename: 'app',
                suffix: '.min'
            }))
            .pipe(opt.load.header(opt.banner, { pkg : opt.pkg } ))
            .on('error', opt.load.util.log)
            .pipe(opt.gulp.dest(opt.DIR + '/css'))
            .pipe(opt.browserSync.stream());
    });

    // Вотчеры SASS файлов
    opt.gulp.task('sass:watch', ['sass:compile'], function () {
        opt.sassFiles = opt.getModulesFiles(opt.name.scss);
        opt.gulp.watch(['./scss/**/*.scss', '!./scss/libs/**/*', opt.sassFiles], function () {
            if (opt.scssWatchBlocked === false) {
                opt.load.sequence('sass:compile')();
            }
        });
    });

    // Общая задача SASS
    opt.gulp.task('sass', ['sass:watch']);
};