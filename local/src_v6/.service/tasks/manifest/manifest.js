'use strict';

module.exports = function (opt) {

    /**
     * Узнаём язык проекта из главного шаблона PUG
     * @method getLang
     */
    function getLang() {
        var langRegExp = /\'([a-z]{2}-[A-Z]{2})\'/g; // https://www.regextester.com/?fam=106747
        var file = opt.fs.readFileSync(opt.mainLayoutPath, opt.encoding);
        var lang = langRegExp.exec(file)[1];

        return lang || '';
    }

    /**
     * Исключена ли иконка из генерации
     * @method isExcludedIcon
     */
    function isExcludedIcon(iconName) {
        var isExcludedIcon = false;
        opt.manifsetSettings.excludeIcons.forEach(function (excludeIconName) {
            if (iconName === excludeIconName) {
                isExcludedIcon = true;
            }
        });
        return isExcludedIcon;
    }

    /**
     * Создать спсок кастомных иконок
     * @method createCustomsIconsList
     * @param {Array} customIconsPaths - массив путей к кастомным иконкам
     */
    function createCustomsIconsList(customIconsPaths) {
        var customIcons = [];
        customIconsPaths.forEach(function (path) {
            var icon = {};
            if (path.indexOf('/') > -1) {
                icon.name = path.replace(/^.*[\\\/]/, '');
            } else {
                icon.name = path;
            }
            if (icon.name !== opt.manifsetSettings.mainIconName && isExcludedIcon(icon.name) === false) {
                icon.path = path;
                customIcons.push(icon);
            }
        });
        return customIcons;
    }

    /**
     * Удалить иконку
     * @method removeIcon
     * @param {String} platformName - имя платформы
     * @param {String} iconName - имя иконки
     */
    function removeIcon(platformName, iconName) {
        if (typeof opt.manifestGenerator.config.icons[platformName][iconName] !== 'undefined') {
            delete opt.manifestGenerator.config.icons[platformName][iconName];
        }
    }

    /**
     * Удалить ненужные иконки
     * @method removeUnnecessaryIcons
     * @param {Array} customIcons - массив списка кастомных иконок
     */
    function removeUnnecessaryIcons(customIcons) {
        Object.keys(opt.manifestGenerator.config.icons).forEach(function (platformName) {
            Object.keys(opt.manifestGenerator.config.icons[platformName]).forEach(function (iconName) {
                if (isExcludedIcon(iconName) === true) {
                    removeIcon(platformName, iconName);
                } else {
                    customIcons.forEach(function (customIcon) {
                        if (iconName === customIcon.name) {
                            removeIcon(platformName, iconName);
                        }
                    });
                }
            });
        });
    }

    /**
     * Удалить ненужные иконки
     * @method moveCustomIcons
     * @param {Array} customIconsPaths - массив путей кастомных иконок
     * @param {Function} callback - коллбек
     */
    function moveCustomIcons(customIconsPaths, callback) {
        opt.gulp.src(customIconsPaths)
            .pipe(opt.gulp.dest(opt.manifsetSettings.destFolder))
            .on('finish', function () {
                if (typeof callback === 'function') {
                    callback();
                }
            });
    }

    /**
     * Добавить фавикон в корень проекта
     * @method addFaviconToRoot
     * @param {Function} callback - коллбек
     */
    function addFaviconToProjectRoot(callback) {
        var mainFaviconPath = opt.manifsetSettings.destFolder + 'favicon-32x32.png';
        if (opt.doesExist(mainFaviconPath)) {
            opt.gulp.src(mainFaviconPath)
                .pipe(opt.load.rename('favicon.png'))
                .pipe(opt.gulp.dest('../../'))
                .on('finish', function () {
                    if (typeof callback === 'function') {
                        callback();
                    }
                });
        } else {
            if (typeof callback === 'function') {
                callback();
            }
        }
    }

    /**
     * Очищаем папку манифеста
     */
    opt.gulp.task('manifest:del', function () {
        return opt.del([
            opt.manifsetSettings.destFolder,
            '../../favicon.png'
        ], {
            force: true
        });
    });

    /**
     * Генерация фавикона и manifest.json
     */
    opt.gulp.task('manifest', ['manifest:del'], function (done) {
        var mainIconPath = opt.manifsetSettings.iconsFolder + opt.manifsetSettings.mainIconName; // Путь до главной иконки на основе которой генерируются остальные
        var customIconsPaths = opt.getPathFiles(opt.manifsetSettings.iconsFolder, ['svg', 'jpg', 'png', 'ico']); // Получаем список путей иконок
        var mainIconIndex = customIconsPaths.indexOf(mainIconPath); // Находим в списке мутей путь до главной иконки и удаляем его если есть
        if (mainIconIndex >= 0) {
            customIconsPaths.splice(mainIconIndex, 1);
        }
        var customIcons = createCustomsIconsList(customIconsPaths); // Создаём список кастомных иконок
        removeUnnecessaryIcons(customIcons); // Удаляем ненужные иконки
        var iconsOptions = {
            // Platform Options:
            // - offset - offset in percentage
            // - background:
            //   * false - use default
            //   * true - force use default, e.g. set background for Android icons
            //   * color - set background for the specified icons
            android: true,              // Create Android homescreen icon. `boolean` or `{ offset, background }`
            appleIcon: true,            // Create Apple touch icons. `boolean` or `{ offset, background }`
            appleStartup: false,        // Create Apple startup images. `boolean` or `{ offset, background }`
            coast: false,               // Create Opera Coast icon. `boolean` or `{ offset, background }`
            favicons: true,             // Create regular favicons. `boolean`
            firefox: false,             // Create Firefox OS icons. `boolean` or `{ offset, background }`
            windows: {                  // Create Windows 10 tile icons. `boolean` or `{ background }`
                background: opt.sassVars['$body-bg-color'] || ''
            },
            yandex: false               // Create Yandex browser icon. `boolean` or `{ background }`
        };
        var iconsGenerationComplete = {};
        var isAllIconsGenerated = function () {
            var isAllIconsGenerated = true;
            Object.keys(iconsGenerationComplete).forEach(function (platform) {
                if (iconsGenerationComplete[platform] === false) {
                    isAllIconsGenerated = false;
                }
            });
            return isAllIconsGenerated;
        };
        var completePlatformIconsGeneration = function (platform) {
            iconsGenerationComplete[platform] = true;
            if (isAllIconsGenerated() === true) {
                moveCustomIcons(customIconsPaths, function () {
                    addFaviconToProjectRoot(done);
                });
            }
        };
        Object.keys(opt.manifestGenerator.config.defaults.icons).forEach(function (currentPlatform) {
            if (iconsOptions[currentPlatform] === true || typeof iconsOptions[currentPlatform] === 'object') {
                iconsGenerationComplete[currentPlatform] = false;
                var icons = {};
                Object.keys(iconsOptions).forEach(function (platform) {
                    if (currentPlatform === platform) {
                        icons[platform] = iconsOptions[currentPlatform];
                    } else {
                        icons[platform] = false;
                    }
                });
                var iconPath = opt.manifsetSettings.iconsFolder + opt.manifsetSettings.iconsFileNames[currentPlatform];
                if (opt.doesExist(iconPath) === false) {
                    iconPath = mainIconPath;
                }
                opt.gulp.src(iconPath)
                    .pipe(opt.manifestGenerator.stream({
                        path: '', // Путь до папки с иконками и манифестом в local/templates/.default
                        appName: opt.rootDIR, // Название проекта
                        appDescription: opt.pkg.description, // Описание проекта
                        developerName: opt.pkg.author, // Имя разработчика
                        developerURL: opt.pkg.homepage, // Ссылка на сайт разработчика
                        background: opt.sassVars['$body-bg-color'] || '', // Фон приложения
                        theme_color: opt.sassVars['$brand-1'] || '', // Основной цвет приложения
                        start_url: '/', // URL, который загружается, когда пользователь запустил приложение с устройства
                        display: 'standalone', // Режим отображения приложения
                        orientation: 'portrait', // Ориентация приложения
                        version: opt.pkg.version, // Версия приложения
                        lang: getLang(), // Язык приложения
                        logging: false,
                        html: false,
                        pipeHTML: false,
                        replace: true,
                        icons: icons
                    }))
                    .on('error', opt.load.util.log)
                    .pipe(opt.gulp.dest(opt.manifsetSettings.destFolder))
                    .on('finish', function () {
                        completePlatformIconsGeneration(currentPlatform);
                    });
            } else {
                completePlatformIconsGeneration(currentPlatform);
            }
        });
    });
};