!function () {
    'use strict';

    function initSpinners() {
        var selects = $('.ui-spin-2');
        if (selects.length && $.fn.spinner) {
            selects.each(function () {
                var self = $(this);
                self.spinner({
                    disabled: self.prop('disabled')
                });
                if (!self.parent().hasClass('ui-spinner-2')) {
                    self.parent().addClass('ui-spinner-2');
                }
            });
        }
    }

    $(function () {
        initSpinners();
    });
}();