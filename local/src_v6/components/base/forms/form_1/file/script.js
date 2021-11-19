!function () {
    'use strict';

    function initFile() {
        var file = $('.ui-file');
        if (file.length && $.fn.fileupload) {
            file.fileupload();
        }
    }

    $(function () {
        initFile();
    });
}();
