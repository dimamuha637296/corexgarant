
'use strict';

var gulp = require('gulp');
var load = require('gulp-load-plugins')();
var browserSync = require('browser-sync');
var fs  = require('fs');
var buffer = require('vinyl-buffer');
var vinylPaths = require('vinyl-paths');
var del = require('del');
var es = require('event-stream');
var imageminMozjpeg = require('imagemin-mozjpeg');
var SVGO = require('svgo');
var mustache = require('mustache');
var imageSize = require('image-size');
var favicons = require('favicons');
var html2Pug = require('gulp-html2pug');
var path = require('path');

// Настройки сборщика
var opt = {
    gulp: gulp,// Плагин gulp
    load: load,// Плагин автоподключения модулей gulp
    reload: browserSync.reload,
    browserSync: browserSync,
    buffer: buffer,
    vinylPaths: vinylPaths,
    del: del,
    fs: fs,// Плагин файловой системы
    es: es,// Плагин event-stream
    imageminMozjpeg: imageminMozjpeg,
    svgo: new SVGO(),
    mustache: mustache,
    imageSize: imageSize,
    manifestGenerator: favicons, // генератор favicon
    html2Pug: html2Pug,
    rootDIR: path.basename(path.join(__dirname, '../../')),// Корневая директория проекта
    DIR: '../templates/.default',// Путь к шаблону Битрикс
    sass: './scss/',// Путь к папке sass
    sassVars: null, // Инициализация переменной для хранения SCSS переменных
    pkg: require('./package.json'),// Содержимое package.json
    environment: false, // false - prod, true - dev
    banner: ['/*!\n' +
    ' * <%= pkg.name %> v<%= pkg.version %>\n' + // переменные берутся с package.json
    ' * 2014-<%= new Date().getFullYear() %> <%= pkg.author %> (<%= pkg.homepage %>)\n' +
    ' * Based on Bootstrap <%= pkg.bootstrap %>\n' +
    ' * For support please contact us: info \n' +
    ' * bugs in template: \n' +
    ' */ \n'],
    encoding: 'utf8',// Кодировка файлов
    extensions: {
        pug: '.pug',// Расширение pug файлов
        scss: '.scss',// Расширение scss файлов
        js: '.js',// Расширение js файлов
        info: '.info',// Расширение info файлов
        json: '.json', // Расширение json файлов
        html: '.html' // Расширение html файлов
    },
    name: {
        pug: 'index.pug',// Имя pug файлов
        scss: 'style.scss',// Имя scss файлов
        js: 'script.js', // Имя js файлов
        info: 'component.pug', // Имя info файлов
        json: 'data.json' // Имя json файлов
    },
    noBabelSuffix: '.nobabel', // Суффикс в имени js-файлов для игнорирования их babel
    noAttachSuffix: '.noattach', // Суффикс в имени js и css файлов для игнорирования их при подключении в head
    jsLibsBlockName: 'block js-libs', // Блок pug в который будут добавляться js библиотеки
    cssLibsBlockName: 'block css-libs', // Блок pug в который будут добавляться css библиотеки
    jsCompiled: null,
    changedProjPages: null,
    changedStandartPages: null,
    scssWatchBlocked: true,

    // A cache for Gulp tasks. It is used as a workaround for Gulp's dependency resolution
    // limitations. It won't be needed anymore starting with Gulp 4.
    task: {}
};
opt.sassVarsPath = './core/main/variables/' + opt.name.scss; // Путь до файла SCSS переменных
opt.mainLayoutPath = './pages/tpl/main' + opt.extensions.pug; // Путь до главного шаблона PUG
opt.manifsetSettings = {
    iconsFolder: './pic/manifest/', // Папка с иконками для манифеста
    destFolder: opt.DIR + '/manifest/', // Конечная директория для манифеста и иконок
    mainIconName: 'main.png', // Имя главной иконки на основе которой генерируются остальные
    excludeIcons: ['apple-touch-icon-1024x1024.png'], // Исключённые из генерации файлы
    iconsFileNames: { // Имена главных иконок для каждой из платформ
        android: 'android-chrome.png',
        appleIcon: 'apple-touch-icon.png',
        appleStartup: 'apple-touch-startup-image.png',
        coast: 'coast.png',
        favicons: 'favicon.png',
        firefox: 'firefox_app.png',
        windows: 'mstile.png',
        yandex: 'yandex-browser.png',
    }
};
//opt.banner = ['/*!\n' +
//' * v<%= pkg.version %>\n' +
//' * Based on Bootstrap <%= pkg.bootstrap %>\n' +
//' * bugs in template: westy.by@gmail.com \n' +
//' */ \n'];

require('./.service/tasks/service/methods')(opt);
require('./.service/tasks/service/get-modules')(opt);// в объект opt.modulesPaths записывает массив используемых модулей
require('./.service/tasks/service/page-list')(opt);
require('./.service/tasks/service/screen-breakpoints')(opt);
require('./.service/tasks/html/html')(opt);
require('./.service/tasks/css/sass')(opt);
require('./.service/tasks/css/sass-libs')(opt);
require('./.service/tasks/img/png')(opt);
require('./.service/tasks/img/images')(opt);
require('./.service/tasks/img/svg')(opt);
require('./.service/tasks/img/cursor')(opt);
require('./.service/tasks/js/script')(opt);
require('./.service/tasks/js/script-libs')(opt);
require('./.service/tasks/test/block')(opt);
require('./.service/tasks/test/page')(opt);
require('./.service/tasks/manifest/manifest')(opt);

// Build the app from source code
opt.gulp.task('build', opt.load.sequence(
    'getModules',
    'show',
    [
        'sass:block-watch',
        'sass:get-vars'
    ],
    [
        'addScreenBreakPoints',
        'png',
        'svg',
        'cursor',
        'manifest'
    ],
    'ws-pages',
    [
        'sass',
        'sass-libs',
        'script',
        'script-libs',
        'html',
        'images'
    ],
    [
        'sass:unblock-watch',
        'reload'
    ]
));


gulp.task('show-stat', function () {
    console.log('Modules quantity: ' + opt.modulesPaths.length);
    console.log('Original ' + opt.originalCSS);
    console.log('Minified ' + opt.minifiedCSS);
    console.log('Original ' + opt.originalJS);
    console.log('Minified ' + opt.minifiedJS);
    opt.showJsCompileStatus();
});

opt.gulp.task('test', opt.load.sequence(
    ['test:block',
        'test:page']
));

gulp.task('set-dev', function () {
    opt.environment = true;
});

gulp.task('show', function (done) {
    browserSync.init({
        server: {
            baseDir: opt.DIR
        },
        startPath: 'index.html'
    }, function () { // Задаём таймаут перед запуском остальных тасков, после открытия страницы в браузере
        setTimeout(function () {
            done();
        }, 1500);
    });
});

gulp.task('reload', function (done) {
    opt.reload();
    done();
});

// The default task
opt.gulp.task('default', opt.load.sequence(
    'build',
    'show-stat',
    'reload'
));

opt.gulp.task('default-dev', opt.load.sequence(
    'set-dev',
    'build',
    'show-stat',
    'reload'
));