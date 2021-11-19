'use strict';

module.exports = function (opt) {

    var getFiles = function (dir, subdir, filelist) {
        var files = opt.fs.readdirSync(dir);
        filelist = filelist || [];
        files.forEach(function(file) {
            if (opt.doesDir(dir + '/' + file)) {
                filelist = getFiles(dir + '/' + file + '/', subdir, filelist);
            } else {
                var path = dir + file;
                if (path.indexOf(subdir) > -1) {
                    path = path.substr(subdir.length, path.length)
                }
                filelist.push(path);
            }
        });
        return filelist;
    };

    opt.gulp.task('getDynamicPages', function () {
        var files = opt.fs.readdirSync('./pages/proj');
        getFiles('./pages/_standart', './pages/', files);
        opt.dynamicPages = '';
        files.forEach(function(item) {
            var itemWithoutExt = item.substr(0, item.indexOf('.'));
            opt.dynamicPages = opt.dynamicPages + "casper.thenOpen( 'http://localhost:3000/" + itemWithoutExt + ".html' )" +
                ".then(function() {" +
                "   this.wait(1000, function() {" +
                "       phantomcss.screenshot('#db', '"+ itemWithoutExt +"');" +
                "    });" +
                "});";
        });
    });

    opt.gulp.task('getTests:page', function () {
        opt.gulp.src('./.service/tasks/test/cases.js')
            .pipe(opt.load.plumber())
            .pipe(opt.load.insert.append(opt.dynamicPages))// Добавляем в конец файла строки
            .pipe(opt.load.insert.append(opt.fs.readFileSync('./.service/tasks/test/after.js', opt.encoding)))
            .pipe(opt.gulp.dest('./test/page/'));
    });
    opt.gulp.task('phantomcss-lg:page', function () {
        opt.gulp.src('./test/page/cases.js')
            .pipe(opt.load.phantomcss({
                viewportSize: [1500, 1000],// Разрешение экрана
                screenshots: 'test/page/1_lg',// Эталонные скрины
                comparisonResultRoot: false,// Все сравнения
                failedComparisonsRoot: 'test/failed/page/1_lg'// Путь для фейлов
            }));
    });
    opt.gulp.task('phantomcss-md:page', function () {
        opt.gulp.src('./test/page/cases.js')
            .pipe(opt.load.phantomcss({
                viewportSize: [1024, 1000],
                screenshots: 'test/page/2_md',
                comparisonResultRoot: false,
                failedComparisonsRoot: 'test/failed/page/2_md'
            }));
    });
    opt.gulp.task('phantomcss-sm:page', function () {
        opt.gulp.src('./test/page/cases.js')
            .pipe(opt.load.phantomcss({
                viewportSize: [768, 1000],
                screenshots: 'test/page/3_sm',
                comparisonResultRoot: false,
                failedComparisonsRoot: 'test/failed/page/3_sm'
            }));
    });
    // ToDo Вынести повторяющиеся вещи в функции
    opt.gulp.task('phantomcss-mob:page', function () {
        opt.gulp.src('./test/page/cases.js')
            .pipe(opt.load.phantomcss({
                viewportSize: [480, 1000],
                screenshots: 'test/page/4_mob',
                comparisonResultRoot: false,
                failedComparisonsRoot: 'test/failed/page/4_mob'
            }));
    });
    opt.gulp.task('phantomcss-xs:page', function () {
        opt.gulp.src('./test/page/cases.js')
            .pipe(opt.load.phantomcss({
                viewportSize: [320, 1000],
                screenshots: 'test/page/5_xs',
                comparisonResultRoot: false,
                failedComparisonsRoot: 'test/failed/page/5_xs'
            }));
    });

    opt.gulp.task('test:page', opt.load.sequence(
        'getDynamicPages',
        'getTests:page',
        'phantomcss-lg:page',
        'phantomcss-md:page',
        'phantomcss-sm:page',
        'phantomcss-mob:page',
        'phantomcss-xs:page'
    ));
};