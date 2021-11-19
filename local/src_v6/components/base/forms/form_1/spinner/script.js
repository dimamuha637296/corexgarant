!function () {
    'use strict';

    function initSpinners() {
        var selects = $('.ui-spin');
        if (selects.length && $.fn.spinner) {
            selects.each(function () {
                var self = $(this);
                self.spinner({
                    disabled: self.prop('disabled')
                });
                if (!self.parent().hasClass('ui-spinner')) {
                    self.parent().addClass('ui-spinner');
                }
            });
        }
    }

    $(function () {
        initSpinners();
    });
}();