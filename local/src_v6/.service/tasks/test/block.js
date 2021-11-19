'use strict';

module.exports = function (opt) {

    opt.gulp.task('getTests:block', function (){
        opt.gulp.src('./.service/tasks/test/cases.js')
            .pipe(opt.load.plumber())
            .pipe(opt.load.insert.append(opt.getDynamicString('test.js')))// Добавляем в конец файла строки
            .pipe(opt.load.insert.append(opt.fs.readFileSync('./.service/tasks/test/after.js', opt.encoding)))
            .pipe(opt.gulp.dest('./test/block/'));
    });
    // ToDo: генерировать файл в оперативу, чтоб при удалении папки test и первом запуске сразу работали тесты

    // https://www.npmjs.com/package/phantomcss
    // https://www.npmjs.com/package/gulp-phantomcss
    // https://habrahabr.ru/post/271379/
    opt.gulp.task('phantomcss-lg:block', function (){
        opt.gulp.src('./test/block/cases.js')
            .pipe(opt.load.phantomcss({
                viewportSize: [1500, 1000],// Разрешение экрана
                screenshots: 'test/block/1_lg',// Эталонные скрины
                comparisonResultRoot: false,// Все сравнения
                failedComparisonsRoot: 'test/failed/block/1_lg'// Путь для фейлов
            }));
    });
    opt.gulp.task('phantomcss-md:block', function (){
        opt.gulp.src('./test/block/cases.js')
            .pipe(opt.load.phantomcss({
                viewportSize: [1024, 1000],
                screenshots: 'test/block/2_md',
                comparisonResultRoot: false,
                failedComparisonsRoot: 'test/failed/block/2_md'
            }));
    });
    opt.gulp.task('phantomcss-sm:block', function (){
        opt.gulp.src('./test/block/cases.js')
            .pipe(opt.load.phantomcss({
                viewportSize: [768, 1000],
                screenshots: 'test/block/3_sm',
                comparisonResultRoot: false,
                failedComparisonsRoot: 'test/failed/block/3_sm'
            }));
    });
    opt.gulp.task('phantomcss-mob:block', function (){
        opt.gulp.src('./test/block/cases.js')
            .pipe(opt.load.phantomcss({
                viewportSize: [480, 1000],
                screenshots: 'test/block/4_mob',
                comparisonResultRoot: false,
                failedComparisonsRoot: 'test/failed/block/4_mob'
            }));
    });
    opt.gulp.task('phantomcss-xs:block', function (){
        opt.gulp.src('./test/block/cases.js')
            .pipe(opt.load.phantomcss({
                viewportSize: [320, 1000],
                screenshots: 'test/block/5_xs',
                comparisonResultRoot: false,
                failedComparisonsRoot: 'test/failed/block/5_xs'
            }));
    });

    opt.gulp.task('test:block', opt.load.sequence(
        'getModules',
        'getTests:block',
        'phantomcss-lg:block',
        'phantomcss-md:block',
        'phantomcss-sm:block',
        'phantomcss-mob:block',
        'phantomcss-xs:block'
    ));
};