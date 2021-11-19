!function () {
    'use strict';

    function initFile() {
        var file = $('.ui-file-2');
        if (file.length && $.fn.fileupload) {
            file.fileupload();
        }
    }

    $(function () {
        initFile();
    });
}();
