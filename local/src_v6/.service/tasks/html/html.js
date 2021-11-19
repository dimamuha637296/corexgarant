'use strict';

var childProcess = require('child_process'); // Модуль Node.js для распараллеливания
var os = require('os'); // Модуль Node.js для информации об OS

module.exports = function (opt) {

    /**
     * Делит массив на указанное количество частей в виде массивов
     *
     * @param {Array} arr - Масив для разделения на части
     * @param {number} partsCount - Количество частей, на которые нужно поделить массив
     *
     * @returns {Array} Массив из частей входного массива в виде вложенных массивов
     */
    function splitByParts(arr, partsCount) {
        if (partsCount < 2) {
            return [arr];
        }

        var length = arr.length;
        var result = [];
        var i = 0;
        var size;

        if (length % partsCount === 0) {
            size = Math.floor(length / partsCount);
            while (i < length) {
                result.push(arr.slice(i, i += size));
            }
        } else {
            while (i < length) {
                size = Math.ceil((length - i) / partsCount--);
                result.push(arr.slice(i, i += size));
            }
        }
        return result;
    }

    /**
     * Запускает компиляцию страниц
     *
     * @param {string} taskName - Название таска
     * @param {Array} src - Масив путей страниц для компиляции
     * @param {string} dest - Конечный путь для готовых страниц
     * @param {string} data - JSON данные для страниц
     * @param {Function} callback - Callback функция для вызова при завершении компиляции страниц
     */
    function runPagesCompile(taskName, src, dest, data, callback) {
        var cpusCount = os.cpus().length; // Получаем количество ядер процессора
        var splitedPages = splitByParts(src, cpusCount); // Делим полученный массив страниц на равные доли в зависимости от количества ядер
        var workersCount = splitedPages.length; // Получаем итоговое количество процессов компиляции для запуска в зависимости от количества чанков страниц

        // Проходим по чанкам страниц для компиляции
        splitedPages.forEach(function (item) {
            var worker = childProcess.fork(process.argv[1], [taskName, '--silent']); // Запускаем процесс компиляции на отдельном ядре процессора
            var sendInfo = { // Список страниц и директория для их расположения
                src: item,
                dest: dest,
                dataJson: data,
                pagesList: opt.pagesList,
                sassVars: opt.sassVars
            };

            worker.on('message', function (data) { // Когда процесс сообщает, что он запущен, отправляем ему список страниц и директорию для их расположения
                if (data.isWorkerReady === true) {
                    worker.send(sendInfo);
                }
            });
            worker.on('exit', function () { // При завершении компиляции страницы уменьшаем счётчик текущих процессов и если он равен нулю вызываем переданный callback
                workersCount--;
                if (workersCount === 0) {
                    callback();
                }
            });
        });
    }

    /**
     * Вставляем pug с подключением библиотек
     *
     * @param {File} file - Файл в которым вставляем код подключеия
     * @param {Array} libsArr - Масив путей страниц для компиляции
     * @param {string} blockName - Имя блока в который будут подключатсья js-библиотеки
     * @param {boolean} isJs - Является ли переданный массив библиотек массивом js библиотек
     */
    function insertLibs(file, libsArr, blockName, isJs) {
        if (libsArr.length) {
            var content = file.contents.toString(); // Преобразовываем содержимое файла в строку
            var blockNameIndex = content.indexOf(blockName); // Ищем в файле blockName
            if (blockNameIndex === -1) { // Если в файле нет blockName то добавляем его
                content += '\n' + blockName;
            }
            libsArr.forEach(function (lib) { // Проходим по массиву библиотек страницы
                if (lib.name.indexOf(opt.noAttachSuffix) === -1) {
                    var linkString = '\n  ';
                    var libName = lib.name.replace(opt.noBabelSuffix, '');
                    if (isJs === true) { // Формируем код с подключением для вставки
                        linkString += 'script(src=DB.DIR + "js/libs/' + libName + '.min.js")';
                    } else {
                        linkString += 'link(rel="stylesheet", href=DB.DIR + "css/libs/' + libName + '.min.css")';
                    }
                    if (blockNameIndex === -1) { // Если в файле нет blockName просто добавляем код вставкии в конце файла, иначе после имеющегося blockName
                        content += linkString;
                    } else {
                        var firstContentPart = content.slice(0, blockNameIndex + blockName.length);
                        var secondContentPart = content.slice(blockNameIndex + blockName.length);
                        content = firstContentPart + linkString + secondContentPart;
                    }
                }
            });

            file.contents = Buffer.from(content); // Записываем новое содержимое файла в переданный файл
        }
        return file; // Возвращаем изменённый файл
    }

    /**
     * Меняем в html всех вхождения #{$НАЗВАНИЕ_ПЕРЕМЕННОЙ} на значение переменной из scss
     *
     * @param {string} html - html
     * @param {Object} sassVars - sass переменные
     */
    function insertSassVars(html, sassVars) {
        var sassVarRegExp = /\#\{(\$[^\}\s]*)\}/g; //https://www.regextester.com/?fam=106742
        return html.replace(sassVarRegExp, function (str, varName) {
            return sassVars[varName] || '';
        });
    }

    // Таск для компиляции страниц в отдельном процессе
    opt.gulp.task('html:compile', function (done) {
        process.on('message', function (data) {
            opt.gulp.src(data.src)
                .pipe(opt.load.plumber())
                .pipe(opt.load.data(function (file) {
                    var pagePath = file.path.replace(/\\/g, '/'); // Исправляем слеши в пути к файлу
                    pagePath = '.' + pagePath.slice(pagePath.indexOf('/pages')); // Обрезаем путь до директори pages
                    var newFile = file;
                    data.pagesList.forEach(function (page) { // Проходим по массиву страниц и найдя нужную берём её js-libs
                        if (page.path === pagePath) {
                            newFile = insertLibs(newFile, page.libs.js, opt.jsLibsBlockName, true); // Дописываем в файл подключение js библиотек
                            newFile = insertLibs(newFile, page.libs.css, opt.cssLibsBlockName, false); // Добавляем в файл подключение css библиотек
                        }
                    });
                    return newFile; // Передаём изменённый pug файл дальше
                }))
                .pipe(opt.load.pug({
                    //pretty: true// не сжимать html
                    data: data.dataJson,
                    pretty: '\t'// форматировать табами
                }))
                .on('error', opt.load.util.log)
                .pipe(opt.gulp.dest(function (file) {
                    var pagesDir = 'proj';
                    if (file.path.indexOf('_standart') > -1) {
                        pagesDir = '_standart';
                    }
                    var newDest = data.dest + file.path.split(pagesDir).pop();
                    newDest = newDest.replace(/\\/g, '/');
                    newDest = newDest.slice(0, newDest.lastIndexOf('/'));

                    var pageHtml = file.contents.toString(); // Получаем HTML страницы
                    pageHtml = insertSassVars(pageHtml, data.sassVars); // Меняем в нём все вхождения scss переменных на их значения
                    file.contents = Buffer.from(pageHtml); // Сохраняем полученный результат

                    return newDest;
                }))
                .on('end', function () {
                    done();
                    process.exit();
                });
        });
        process.send({ // Отправляем родительскому процессу сообщение о том, что данный дочерний процесс запущен
            isWorkerReady: true
        });
    });

    // Собираем массив путей страниц проекта
    opt.gulp.task('html:proj-getArr', function (done) {
        opt.projPages = opt.getPathFiles('./pages/proj/', opt.extensions.pug);
        done();
    });

    // Собираем html страниц проекта
    opt.gulp.task('html:proj', ['html:proj-getArr'], function (done) {
        // Записываем в список страниц для компиляции те, чтобы были сформированы вотчером или все обычные страницы
        var pages = opt.changedProjPages || opt.projPages;

        // Если страницы для обновления есть, запускаем их асинхронную компиляцию
        if (pages.length) {
            runPagesCompile('html:compile', pages, opt.DIR, opt.componentsData, function () {
                opt.changedProjPages = null;
                done();
            });
        } else {
            done();
        }
    });

    // Собираем массив путей стандартных внутренних страниц
    opt.gulp.task('html:inner-getArr', function (done) {
        opt.standartPages = opt.getPathFiles('./pages/_standart/', opt.extensions.pug);
        done();
    });

    // Собираем html стандартных внутренних страниц
    opt.gulp.task('html:inner', ['html:inner-getArr'], function (done) {
        // Записываем в список страниц для компиляции те, чтобы были сформированы вотчером или все стандартные внутренние страницы
        var pages = opt.changedStandartPages || opt.standartPages;

        // Если страницы для обновления есть, запускаем их асинхронную компиляцию
        if (pages.length) {
            runPagesCompile('html:compile', pages, opt.DIR + '/_standart', opt.componentsData, function () {
                opt.changedStandartPages = null;
                done();
            });
        } else {
            done();
        }
    });

    // Очищаем папку стандартных внутренних страниц
    opt.gulp.task('html:inner-del', function () {
        return opt.del([
            opt.DIR + '/_standart'
        ], {force: true});
    });

    opt.gulp.task('html:proj-sync', ['html:proj'], opt.reload); // Таск синхронизации страниц проекта
    opt.gulp.task('html:inner-sync', ['html:inner'], opt.reload); // Таск синхронизации внутренних стандартных проекта
    opt.gulp.task('html:all-sync', ['html:proj', 'html:inner'], opt.reload);  // Таск синхронизации всех страниц проекта

    // Вотчеры компонентов и страниц
    opt.gulp.task('html:watch', ['html:proj', 'html:inner'], function () {

        // Вотчер главных страниц
        opt.gulp.watch('./pages/proj/**/*', function (event) {
            opt.changedProjPages = [event.path];
            opt.load.sequence('html:proj-sync')();
        });

        // Вотчер внутренних страниц
        if (opt.environment === true) {
            opt.gulp.watch('./pages/_standart/**/*', function (event) {
                opt.changedStandartPages = [event.path];
                opt.load.sequence('html:inner-sync')();
            });
        }

        // Вотчер темплейтов страниц
        if (opt.environment === true) {
            opt.gulp.watch('./pages/tpl/**/*', ['html:all-sync']);
        } else {
            opt.gulp.watch('./pages/tpl/**/*', ['html:proj-sync']);
        }

        // Вотчер компонентов
        opt.htmlFiles = opt.getModulesFiles(opt.name.pug);
        opt.gulp.watch(opt.htmlFiles, function (event) {
            var path = event.path.substring(event.path.indexOf('components')); // Получаем путь до изменённого файла начиная с директории src
            path = path.replace(/\\/g, '/'); // Убираем из пути двойные слэши
            path = './' + path; // Добавляем "./" в начало пути
            opt.changedProjPages = []; // Объявляем пустой массив изменённых страниц
            opt.changedStandartPages = []; // Объявляем пустой массив изменённых стандартных внутренних страниц
            opt.modules.forEach(function (item) { // Проходим по массиву объектов связей компонентов со страницами
                if (item.path === path) { // Если путь компонента совпадает, проходим по массиву страниц, на которых он имеется
                    item.pages.forEach(function (item) {
                        if (item.indexOf('./pages/proj/') > -1) {
                            opt.changedProjPages.push(item);
                        }
                        if (item.indexOf('./pages/_standart/') > -1) {
                            opt.changedStandartPages.push(item);
                        }
                    });
                }
            });
            if (opt.changedProjPages.length) { // Если компонент имеется на обычных страницах, обновляем те на которых он имеется
                opt.load.sequence('html:proj-sync')();
            }
            if (opt.changedStandartPages.length && opt.environment === true) { // Если компонент имеется на стандартных внутренних страницах, обновляем те на которых он имеется
                opt.load.sequence('html:inner-sync')();
            }
            if (!opt.changedProjPages.length && !opt.changedStandartPages.length) { // Если компонент не имеется на обычных или внутренних страницах, обновляем все страницы
                opt.changedProjPages = null;
                opt.changedStandartPages = null;
                if (opt.environment === true) {
                    opt.load.sequence('html:all-sync')();
                } else {
                    opt.load.sequence('html:proj-sync')();
                }
            }
        });
    });

    // Общая задача html
    opt.gulp.task('html', ['html:watch']);
};