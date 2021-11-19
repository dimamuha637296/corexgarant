'use strict';

module.exports = function (opt) {

    // Собираем список модулей
    opt.gulp.task('getModules', function (done) {

        var htmlParser = {

            /**
             * Устанавливаем глобальные переменные
             */
            setOptVars: function () {
                opt.jsLibs = this.libsList.js.paths || [];
                opt.cssLibs = this.libsList.css.paths || [];
                opt.pagesList = this.pages;
                opt.modules = this.modules;
                opt.modulesPaths = [];
                this.modules.forEach(function (module) {
                    opt.modulesPaths.push(module.path);
                });
            },

            /**
             * Добавляем бибилотеку
             *
             * @param {string} libType - Тип библиотеки
             * @param {string} libPath - Путь до библиотеки
             * @param {Array} pages - Массив страниц на которых содержится библиотека
             */
            addLib: function (libType, libPath, pages) {
                // Получаем имя библиотеки с расширением
                var libName = libPath.slice(libPath.lastIndexOf('/') + 1);
                // Удаляем расширение библиотеки
                libName = libName.slice(0, libName.lastIndexOf('.'));
                // Проходим по страницам проекта
                htmlParser.pages.forEach(function (page) {
                    // Если на странице имеется библиотека, добавляем её к ней в список
                    if (pages.indexOf(page.path) > -1) {
                        if (page.libs[libType] === undefined) {
                            page.libs[libType] = [{
                                path: libPath,
                                name: libName
                            }];
                        } else {
                            var isLibExist = false;

                            page.libs[libType].forEach(function (lib) {
                                if (lib.name === libName) {
                                    isLibExist = true;
                                }
                            });
                            if (isLibExist === false) {
                                page.libs[libType].push({
                                    path: libPath,
                                    name: libName
                                });
                            }
                        }
                    }
                });

                // Заполняем массив имён и путей библиотек
                if (htmlParser.libsList[libType].names === undefined) {
                    htmlParser.libsList[libType].names = [libName];
                    htmlParser.libsList[libType].paths = [libPath];
                } else {
                    var isLibExist = false;

                    htmlParser.libsList[libType].names.forEach(function (name) {
                        if (name === libName) {
                            isLibExist = true;
                        }
                    });
                    if (isLibExist === false) {
                        htmlParser.libsList[libType].names.push(libName);
                        htmlParser.libsList[libType].paths.push(libPath);
                    }
                }
            },

            /**
             * Собираем подключенные библиотеки
             */
            collectLibs: function () {
                // Проходим по подключенным модулям
                htmlParser.modules.forEach(function (module) {
                    // Проходим по имеющимся типам библиотек
                    Object.keys(htmlParser.libsList).forEach(function (libType) {
                        // Формируем путь до директории с библиотеками
                        var libFolder = module.path + htmlParser.libsList[libType].folderName + '/';
                        // Если директория библиотеки имеется, получаем из неё список файлов и добавляем их список подключенных библиотек
                        if (opt.doesDir(libFolder)) {
                            var libsPaths = opt.getPathFiles(libFolder, htmlParser.libsList[libType].extension);
                            libsPaths.forEach(function (libPath) {
                                htmlParser.addLib(libType, libPath, module.pages);
                            });
                        }
                    });
                });
            },

            /**
             * Из локального пути убираем множество ../../
             *
             * @param {string} path - Путь из которого убираем ../../
             */
            deletePoints: function (path) {
                if (path.indexOf('../') > -1) {

                    // Определяем позицию ../
                    var slashPos = path.indexOf('../');

                    // Удаляем 1 уровень слева от ../
                    var stringWithoutSlash = path.substring(0, slashPos - 1);
                    var stringWithoutOneLvlPos = stringWithoutSlash.lastIndexOf('/');
                    var stringWithoutOneLvl = stringWithoutSlash.substring(0, stringWithoutOneLvlPos + 1);

                    // Удаляем 1 уровень справа от ../
                    var stringWithoutPoints = path.substring(slashPos, path.length);
                    var stringWithoutOnePoints = stringWithoutPoints.substring(3, stringWithoutPoints.length);

                    // Склеиваем обратно в одну строку
                    var fixedPath = stringWithoutOneLvl + stringWithoutOnePoints;

                    return this.deletePoints(fixedPath);
                } else {
                    return path;
                }
            },

            /**
             * Добавляем модуль
             *
             * @param {string} modulePath - Путь до модуля
             * @param {string} pagePath - Путь до страницы на которой содержится модуль
             */
            addModule: function (modulePath, pagePath) {
                var isModuleExist = false;

                // Собираем зависимости этого модуля
                // Должен идти первым, т.к. сначала импортируем зависимости, только потом их используем
                // ./core/init/ будет подключаться после подключения всего ядра, но там нет ничего
                htmlParser.getInnerModules(modulePath + opt.name.info, opt.name.info, htmlParser.options.includeName, function (dependencyPath) {
                    htmlParser.addModule(dependencyPath, pagePath);
                });

                htmlParser.modules.forEach(function (module) { // Проходим по списку подключенных модулей
                    // Если модуль уже имеется в списке подключенных, добавляем к нему страницу на которой он содержится, если её нет
                    if (module.path === modulePath) {
                        isModuleExist = true;
                        if (module.pages.indexOf(pagePath) === -1) {
                            module.pages.push(pagePath);
                        }
                    }
                });

                // Если модуля нет в списке подключенных, добавляем его
                if (isModuleExist === false) {
                    htmlParser.modules.push({
                        path: modulePath,
                        pages: [pagePath]
                    });
                }
            },

            /**
             * Очищаем путь до подключенного модуля
             *
             * @param {string} innerModulePath - Путь до подключенного модуля
             * @param {string} currentModulePath - Путь до файла в котором найдено подключение модуля
             * @param {string} insertType - Тип подключения модуля (include или extends)
             */
            cleanPath: function (innerModulePath, currentModulePath, insertType) {
                // Удаляем со строки пробелы, табуляцию
                var clearPath = innerModulePath.replace(/\s/g, '');
                // Из локального пути убираем insertType
                clearPath = clearPath.replace(insertType, '');
                // В локальный путь прописываем полный путь к файлу
                clearPath = currentModulePath.substring(0, currentModulePath.lastIndexOf('/') + 1) + clearPath;
                // Из локального пути убираем множество ../../ и возвращаем результат
                return htmlParser.deletePoints(clearPath);
            },

            /**
             * Проверяем содержит ли строка путь до модуля
             *
             * @param {string} item - Провреямая на содержание пути модуля строка
             * @param {string} insertType - Тип подключения модуля (include или extends)
             */
            hasModuleInsert: function (item, insertType) {
                // Проверяем имеется ли подключение модуля через переданный insertType
                var insertIndex = item.indexOf(insertType);
                if (insertIndex < 0) {
                    return false;
                }
                // Проверяем закомментирована ли строка перед переданным insertType
                var commentIndex = item.indexOf('//');
                if (commentIndex > -1 && insertIndex > commentIndex) {
                    return false;
                }
                return true;
            },

            /**
             * Получаем массив подкюченных модулей рекурсивно
             *
             * @param {string} filePath - Путь до файла в котором исчем подключение модулей
             * @param {string} extension - Расширение файла
             * @param {string} insertType - Тип подключения модуля (include или extends)
             * @param {Function} callback - Callback функция для вызова при нахождении подключения модуля
             */
            getInnerModules: function (filePath, extension, insertType, callback) {
                if (opt.doesExist(filePath)) {
                    var fileContent = opt.fs.readFileSync(filePath, opt.encoding); // Считываем содержимое файла
                    var strings = fileContent.split('\n'); // Разбиваем файл на массив строк по символу переноса строки

                    // Проходим по строкам файла в поисках подключенного модуля
                    strings.forEach(function (item) {
                        // Завершаем итерацию, если нет инклуда или если строка закоментирована перед insertType
                        if (htmlParser.hasModuleInsert(item, insertType) === false) {
                            return false;
                        }
                        // Получаем полный путь до подключенного модуля
                        var clearPath = htmlParser.cleanPath(item, filePath, insertType);
                        // Удаляем имя файла
                        if (extension !== opt.name.info && insertType !== htmlParser.options.extendName) {
                            clearPath = clearPath.substring(0, clearPath.lastIndexOf('/') + 1);
                        } else {
                            if (insertType !== htmlParser.options.extendName) {
                                // clearPath += '/';
                            } else {
                                clearPath += opt.extensions.pug;
                            }
                        }
                        // Передаём полученный путь модуля в callback
                        callback(clearPath);
                        // Получившийися путь к модулю проходим на уровень глубже
                        htmlParser.getInnerModules(clearPath + extension, extension, insertType, callback);
                    });
                }
            },

            /**
             * Собираем подключенные модули
             */
            collectModules: function () {
                // Проходим по списку имеющихся страниц
                htmlParser.pages.forEach(function (page) {
                    // Получаем extends страницы
                    htmlParser.getInnerModules(page.path, opt.name.pug, htmlParser.options.extendName, function (extendPath) {
                        // Собираем модули из полученных extends
                        htmlParser.getInnerModules(extendPath, opt.name.pug, htmlParser.options.includeName, function (modulePath) {
                            // Добавляем модуль в список подключенных модулей
                            htmlParser.addModule(modulePath, page.path);
                        });
                    });
                    // Собираем модули страницы
                    htmlParser.getInnerModules(page.path, opt.name.pug, htmlParser.options.includeName, function (modulePath) {
                        // Добавляем модуль в список подключенных модулей
                        htmlParser.addModule(modulePath, page.path);
                    });
                });
            },

            /**
             * Добавляем страницу
             *
             * @param {string} path - Путь до страницы
             */
            addPage: function (path) {
                var isPageExist = false;

                // Проверяем имеется ли страница в списке уже имеющихся страниц
                this.pages.forEach(function (page) {
                    if (page.path === path) {
                        isPageExist = true;
                    }
                });

                // Если страница нет в списке имеющихся, добавляем её
                if (isPageExist === false) {
                    this.pages.push({
                        path: path,
                        libs: {
                            js: [],
                            css: []
                        }
                    });
                }
            },

            /**
             * Собираем страницы
             */
            collectPages: function () {
                // Проходим по списку директорий со страницами
                htmlParser.options.pagesDir.forEach(function (pagesDir) {
                    // Собираем список путей страниц из директории
                    var pagesPaths = opt.getPathFiles(pagesDir, opt.extensions.pug);

                    // Проходим по полученному списку путей страниц и добавляем каждую страницу в список страниц проекта
                    pagesPaths.forEach(function (pagePath) {
                        htmlParser.addPage(pagePath);
                    });
                });
            },

            /**
             * Проверяем существование папок
             *
             * @param {Array} arr - Массив путей директорий
             */
            addDirSrc: function(arr) {
                var arResult = [];
                arr.map(function(item) {
                    if (opt.doesExist(item)) {
                        arResult.push(item);
                    }
                });
                return arResult;
            },

            /**
             * Инициализируем сборку модулей проекта
             */
            init: function () {
                this.options = {
                    pagesDir: this.addDirSrc(['./pages/proj/', './pages/_standart/']), // Пути директорий страниц
                    includeName: 'include', // Имя include'ов
                    extendName: 'extends' // Имя extend'ов
                };
                this.libsList = {
                    js: {
                        folderName: 'libs/js', // Директория в которой у модули хрянят js библиотеки
                        extension: opt.extensions.js // Расширение js библиотек
                    },
                    css: {
                        folderName: 'libs/css', // Директория в которой у модули хрянят css библиотеки
                        extension: opt.extensions.scss // Расширение css библиотек
                    }
                };
                this.pages = []; // Список страниц
                this.modules = []; // Список модулей
                this.collectPages(); // Собираем страницы
                this.collectModules(); // Собираем модули
                this.collectLibs(); // Собираем библиотеки
                this.setOptVars(); // Устанавливаем глобальные переменные
            }
        };

        // Инициализируем сборку модулей проекта
        htmlParser.init();
        console.log(opt.modulesPaths);
        done();
    });
};