!function () {
    'use strict';

    function initSelects() {
        var selects = $('.ui-select-2');
        if (selects.length && $.fn.selectmenu) {
            selects.each(function () {
                var self = $(this);
                if (!self.parent().hasClass('ui-front-2')) {
                    self.parent().addClass('ui-front-2');
                }
                self.selectmenu({
                    change: function () {
                        if ($.fn.validate) {
                            self.closest('form').validate().element(this);
                        }
                    }
                });
            });
        }
    }

    $(function () {
        initSelects();
    });
}();