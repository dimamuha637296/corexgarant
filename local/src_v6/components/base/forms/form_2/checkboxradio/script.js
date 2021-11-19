!function () {
    'use strict';

    function initCheckBoxes() {
        var selects = $('.ui-checkbox-2');
        if (selects.length && $.fn.checkboxradio) {
            selects.each(function () {
                var self = $(this);
                self.checkboxradio({});
            });
        }
    }

    $(function () {
        initCheckBoxes();
    });
}();