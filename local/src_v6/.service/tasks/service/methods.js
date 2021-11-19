'use strict';

module.exports = function (opt) {

    // Проверяем, существует ли файл
    opt.doesExist = function (path) {
        try {
            opt.fs.statSync(path);
            return true;
        } catch(err) {
            return !(err && err.code === 'ENOENT');
        }
    };

    // Проверяем, Это папка или нет
    opt.doesDir = function (path) {
        try {
            return opt.fs.statSync(path).isDirectory();
        } catch(err) {
            return !(err && err.code === 'ENOENT');
        }
    };

    // Проверяем, Это файл или нет
    opt.doesFile = function (path) {
        try {
            return opt.fs.statSync(path).isFile();
        } catch(err) {
            return !(err && err.code === 'ENOENT');
        }
    };

    // Получаем рекурсивно массив файлов из папки и всех вложенных в неё папок
    opt.getFilesFromDir = function(dir, filelist) {
        var files = opt.fs.readdirSync(dir);
        filelist = filelist || [];
        files.forEach(function(file) {
            if (opt.doesDir(dir + file)) {
                filelist = opt.getFilesFromDir(dir + file + '/', filelist);
            } else {
                filelist.push(dir + file);
            }
        });
        return filelist;
    };

    // Собираем пути картинок из модулей в массив
    opt.getImgArrPath = function (path) {
        var arrPath = [];
        opt.modulesPaths.forEach(function (item, i, arr) {

            // Прописываем путь до каждого компонента папки sprite
            var newPath;
            if (item.lastIndexOf('/') > -1) {
                newPath = item.substring(0, item.lastIndexOf('/') + 1) + path + '/';
            }

            // Проверяем, существует ли папка images
            if (opt.doesExist(newPath) === true) {
                arrPath.push(newPath + '**/*');
            }
        });

        // В массив картинок добавляем безусловные картинки (всегда попадают в images)
        arrPath.push('./pic/' + path + '/**/*');
        return arrPath;
    };

    // Собираем пути иконок из модулей в массив
    opt.getSvgArrPath = function (path) {
        var arrPath = [];
        opt.modulesPaths.forEach(function (item, i, arr) {
            // Прописываем путь до каждого компонента папки sprite
            var newPath;
            if (item.lastIndexOf('/') > -1) {
                newPath = item.substring(0, item.lastIndexOf('/') + 1) + path + '/';
            }
            // Проверяем, существует ли папка
            if (opt.doesExist(newPath) === true) {
                opt.fs.readdirSync(newPath).forEach(function (item2, i, arr) {
                    var newItem = newPath + item2;
                    if (opt.doesFile(newItem)) {
                        // Определяем, встречается ли такое имя в массиве
                        var hasInArr = false;
                        arrPath.forEach(function (item3) {
                            if (item3.substring(item3.lastIndexOf('/') + 1, item3.length) === item2) {
                                hasInArr = true;
                            }
                        });
                        // Если нет - пушим
                        if (hasInArr === false) {
                            arrPath.push(newItem);
                        }
                    }
                });
            }
        });

        //Возвращаем массив путей к файлам

        return arrPath;
    };


    // Собираем в строку динамические строки из компонентов
    opt.getDynamicString = function (file) {
        var string = '';
        opt.modulesPaths.forEach(function (item, i, arr) {
            var path = item + file;
            if (opt.doesExist(path) === true) {
                string += opt.fs.readFileSync(path, opt.encoding) + '\n';
            }
        });
        return string;
    };

    /**
     * Собираем в массив список файлов с указанным именем из подключенных модулей
     *
     * @param {string} file - Название файла
     *
     * @returns {Array} Массив путей к файлам
     */
    opt.getModulesFiles = function (file) {
        var arrPath = [];
        opt.modulesPaths.forEach(function (item) {
            var path = item + file;
            if (opt.doesExist(path) === true) {
                arrPath.push(path);
            }
        });
        return arrPath;
    };

    /**
     * Собираем в массив список файлов с нужным расширением из указанной директории
     *
     * @param {string} path - Путь до требуемой директории
     * @param {Array|string} extension - Расширение файлов
     * @param {Array} arr - Уже имеющийся массив
     *
     * @returns {Array} Массив путей к файлам
     */
    opt.getPathFiles = function (path, extension, arr) {
        var arrPath = arr || [];
        if (opt.doesExist(path) === true) {
            var files = opt.fs.readdirSync(path);
            files.forEach(function (item) {
                var newPath = path + item;
                if (opt.doesDir(newPath)) {
                    opt.getPathFiles(newPath + '/', extension, arrPath);
                } else {
                    if (extension !== undefined) {
                        if (Array.isArray(extension) === true) {
                            extension.forEach(function (item) {
                                if (newPath.endsWith(item)) {
                                    arrPath.push(newPath);
                                }
                            });
                        } else {
                            if (newPath.endsWith(extension)) {
                                arrPath.push(newPath);
                            }
                        }
                    } else {
                        arrPath.push(newPath);
                    }
                }
            });
        }
        return arrPath;
    };

    /**
     * Отобразить статус компиляции JS
     */
    opt.showJsCompileStatus = function () {
        if (opt.jsCompiled === false) {
            console.log('\x1b[31m%s\x1b[0m', 'JS was not compiled due to errors!'); // Использован стилизованный console.log поскольку console.error в Node.JS асинхронный
        }
    };

    /**
     * Конвертация байтов в читаемый формат
     *
     * @param {number} bytes - число байтов
     *
     * @returns {string} размер в человекопонятном виде (например "1,54 MB")
     */
    opt.makeBytesReadable = function (bytes) {
        var sizeNames = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        var sizeNameIndex = 0;

        if (bytes !== 0) {
            sizeNameIndex = parseInt(Math.floor(Math.log(Math.abs(bytes)) / Math.log(1024)));
        }

        if (sizeNameIndex === 0 || sizeNameIndex >= sizeNames.length) {
            return bytes + ' ' + sizeNames[0];
        } else {
            return ((bytes / Math.abs(bytes)) * (Math.abs(bytes) / Math.pow(1024, sizeNameIndex)).toFixed(2)) + ' ' + sizeNames[sizeNameIndex];
        }
    };

    /**
     * Получить структуру директории
     *
     * @param {string} params.path - путь директории
     * @param {Array} params.structure - текущая структура
     * @param {Array} params.allowedFileExtensions - допустимые расширения файлов
     * @param {Boolean} params.includeDirectory - включать ли в структуру самую директорию
     *
     * @returns {Array} структура директории
     */
    opt.getDirectoryStructure = function (params) {
        var path = params.path;
        var structure = params.structure || [];
        var allowedFileExtensions = params.allowedFileExtensions || [];
        var includeDirectory = params.includeDirectory || false;

        if (includeDirectory === true) {
            var folder = {
                name: path.match(/.*\/([^\/]+)\//)[1], // https://www.regextester.com/?fam=109426
                type: 'folder',
                path: path,
                structure: []
            };
            folder.structure = opt.getDirectoryStructure({
                path: path,
                structure: folder.structure,
                allowedFileExtensions: allowedFileExtensions
            });
            var folders = [];
            var files = [];
            folder.structure.forEach(function (folderItem) {
                if (folderItem.type === 'folder') {
                    folders.push(folderItem);
                }
                if (folderItem.type === 'file') {
                    files.push(folderItem);
                }
            });
            folder.structure = folders.concat(files);
            structure.push(folder);
        } else {
            if (opt.doesDir(path) === true) {
                var directoryItems = opt.fs.readdirSync(path);
                directoryItems.forEach(function (item) {
                    var itemPath = path + item;
                    if (opt.doesDir(itemPath) === true) {
                        var folder = {
                            name: item,
                            type: 'folder',
                            path: itemPath,
                            structure: []
                        };
                        folder.structure = opt.getDirectoryStructure({
                            path: itemPath + '/',
                            structure: folder.structure,
                            allowedFileExtensions: allowedFileExtensions
                        });
                        var folders = [];
                        var files = [];
                        folder.structure.forEach(function (folderItem) {
                            if (folderItem.type === 'folder') {
                                folders.push(folderItem);
                            }
                            if (folderItem.type === 'file') {
                                files.push(folderItem);
                            }
                        });
                        folder.structure = folders.concat(files);
                        structure.push(folder);
                    } else {
                        var file = {
                            name: item.substr(0, item.lastIndexOf('.')),
                            extension: item.substring(item.lastIndexOf('.')),
                            type: 'file',
                            path: itemPath
                        };
                        if (allowedFileExtensions.length > 0) {
                            if (allowedFileExtensions.indexOf(file.extension) >= 0) {
                                structure.push(file);
                            }
                        } else {
                            structure.push(file);
                        }
                    }
                });
            }
        }

        return structure;
    };
};