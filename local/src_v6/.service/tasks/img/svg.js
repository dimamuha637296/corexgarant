'use strict';

module.exports = function (opt) {

    // Собираем пути картинок из модулей в массив
    opt.gulp.task('svg:getArr', function () {
        // массив путей картинок из компонентов svg
        opt.arrSvg = opt.getSvgArrPath('svg');
    });

    // Конвертируем SVG икноки в base64 и генерируем файл стилей с этими икноками в background-image
    opt.gulp.task('svg:main', ['svg:getArr'], opt.task.svg = function () {
        var scss = '';// Итоговые стили

        if (opt.arrSvg.length) {

            //Шаблон mustache для генерации файла стилей
            var mustacheTemplate = opt.fs.readFileSync('./core/util/svg/svg.mustache', opt.encoding);

            //Объект данных для генерации стилей на основе шаблона mustache
            var mustacheData = {
                svgArr: []
            };

            //Проходим по всем svg файлам
            /**
             * @param {Object} item Путь до файла svg
             */
            opt.arrSvg.forEach(function (item) {
                var fileName = item.substring(item.lastIndexOf('/') + 1, item.lastIndexOf('.'));
                var file = opt.fs.readFileSync(item, opt.encoding);

                //Генерируем стили для svg через SVGO
                opt.svgo.optimize(file, function (result) {
                    //Создаём объект параметров svg
                    var svg = {
                        dataurl: encodeURIComponent(result.data),
                        width: result.info.width,
                        height: result.info.height,
                        filename: fileName
                    };
                    //Если ширина или высота svg определилась наверно, пересчитываем их
                    if (svg.width === undefined || svg.height === undefined) {
                        var svgSizes = opt.imageSize(item);
                        svg.width = svg.width || svgSizes.width;
                        svg.height = svg.height || svgSizes.height;
                    }
                    // При помощи регулярного выражения меняем вид "%23%7B%24 НАЗВАНИЕ_ПЕРМЕННОЙ %7D" на "#{$НАЗВАНИЕ_ПЕРЕМЕННОЙ}"
                    // https://www.regextester.com/?fam=104719
                    svg.dataurl = svg.dataurl.replace(/\%23\%7B\%24([^\%7D]*)\%7D/g, function (str, varName) {
                        return '%23#{str-slice(#{$' + varName + '}, 2, -1)}';
                    });
                    //Помещаем его в массив объектов для генерации стилей на основе шаблона mustache
                    mustacheData.svgArr.push(svg);
                });
            });

            //Генерируем итоговые стили на основе шаблона mustache
            scss = opt.mustache.render(mustacheTemplate, mustacheData);
        }

        //Записываем итоговые стили в файл
        opt.fs.writeFileSync('./core/util/svg/style.scss', scss);
    });

    // Пересобираем svg при изменении
    opt.gulp.task('svg-sync', ['svg:main'], opt.reload);

    // Вотчер svg файлов
    opt.gulp.task('svg:watch', ['svg:main'], function () {
        opt.gulp.watch(opt.arrSvg, ['svg-sync']);
    });

    // Асинхронный вызов
    opt.gulp.task('svg', ['svg:watch']);
};