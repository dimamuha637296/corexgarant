'use strict';

module.exports = function (opt) {

    /**
     * Парсинг структуры папок
     * @method parseFolderStructure
     * @param {Object} params - параметры
     * @param {Array} params.structure - структура
     * @param {Object} params.pagesFolder - информация о папке со страницами
     * @param {String} params.pagesFolder.path - путь к папке содержащей страницы
     * @param {String} params.pagesFolder.destPath - путь к папке куда страницы попадают
     *
     * @return {String} HTML меню
     */
    function parseFolderStructure(params) {
        var structure = params.structure || [];
        structure.forEach(function (item) {
            if (item.type === 'file') {
                item.path = item.path.replace(opt.extensions.pug, opt.extensions.html);
                item.path = item.path.replace(params.pagesFolder.path, params.pagesFolder.destPath);
                delete item.extension;
            } else if (item.type === 'folder') {
                item.structure = parseFolderStructure({
                    structure: item.structure,
                    pagesFolder: params.pagesFolder
                });
            }
        });

        return structure;
    }

    /**
     * Создать скрипт
     * @method createScript
     * @return {String} скрипт
     */
    function createScript() {
        var script =
            'ws.module.pages = {\n' +
            '    menuList: ' + JSON.stringify(opt.wsPagesMenuList) + '\n' +
            '};\n\n';

        return script;
    }

    // Собираем названия страниц проекта в массив
    opt.gulp.task('ws-pages:create-menu-html', function (done) {
        var pagesFolderPathList = [
            {
                name: 'standart',
                path: './pages/_standart/',
                destPath: '/_standart/',
                includeDirectory: true
            },
            {
                name: 'main',
                path: './pages/proj/',
                destPath: '/',
                includeDirectory: false
            }
        ];

        opt.wsPagesMenuList = [];
        pagesFolderPathList.forEach(function (pagesFolder, index) {
            if (opt.doesDir(pagesFolder.path) === true) {
                var folderStructure = opt.getDirectoryStructure({
                    includeDirectory: pagesFolder.includeDirectory,
                    path: pagesFolder.path,
                    currentStructure: [],
                    allowedFileExtensions: [opt.extensions.pug]
                });
                var parsedFolderStructure = parseFolderStructure({
                    name: pagesFolder.name,
                    pagesFolder: pagesFolder,
                    structure: folderStructure
                });
                opt.wsPagesMenuList.push({
                    name: pagesFolder.name,
                    structure: parsedFolderStructure
                });
            }
        });

        done();
    });

    // Собираем сгенерированный шаблон компонента ws-pages со списком страниц проекта
    opt.gulp.task('ws-pages:create-script', function () {
        return opt.gulp.src('./core/util/ws_pages/script.nocompile.js')
            .pipe(opt.load.plumber())
            .pipe(opt.load.data(function (file) {
                var newFile = file;
                var content = file.contents.toString();
                content = createScript() + content;
                file.contents = Buffer.from(content);
                return newFile;
            }))
            .pipe(opt.load.rename({
                basename: 'ws-pages',
                suffix: opt.noAttachSuffix
            }))
            .pipe(opt.gulp.dest('./core/util/ws_pages/libs/js'));
    });

    // Общая задача по созданию списк страниц проекта
    opt.gulp.task('ws-pages', opt.load.sequence(
        'ws-pages:create-menu-html',
        'ws-pages:create-script'
    ));
};