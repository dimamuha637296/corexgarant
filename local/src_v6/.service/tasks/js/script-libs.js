'use strict';

module.exports = function (opt) {

    opt.gulp.task('libs-uglify', function () {
        var libsPath = opt.jsLibs.concat(['./js/libs/**/*.js', '!./js/libs/**/*.min.js']);
        return opt.gulp.src(libsPath)
            .pipe(opt.load.plumber())
            .pipe(opt.load.changed(opt.DIR + '/js/libs'))
            .pipe(opt.load.preprocess())
            .pipe(opt.load.babel({
                presets: ['env'],
                plugins: ['transform-es2015-modules-strip', 'transform-object-rest-spread'],
                compact: false,
                ignore: '*' + opt.noBabelSuffix + '.js'
            }))
            .pipe(opt.load.uglify())
            .pipe(opt.load.rename(function (path) {
                var basename = path.basename.replace(opt.noBabelSuffix, '');
                basename = basename.replace(opt.noAttachSuffix, '');
                path.basename = basename + '.min';
            }))
            .on('error', opt.load.util.log)
            .pipe(opt.gulp.dest(opt.DIR + '/js/libs'));
    });

    opt.gulp.task('libs-copy', function () {
        return opt.gulp.src('./js/libs/**/*.min.js')
            .pipe(opt.load.plumber())
            .on('error', opt.load.util.log)
            .pipe(opt.gulp.dest(opt.DIR + '/js/libs'));
    });

    opt.gulp.task(
        'script-libs',
        [
            'libs-uglify',
            'libs-copy'
        ]);

    opt.gulp.task('script-libs-sync', ['script-libs'], opt.reload);
};