!function () {
    'use strict';

    function initSelects() {
        var selects = $('.ui-select');
        if (selects.length && $.fn.selectmenu) {
            selects.each(function () {
                var self = $(this);
                if (!self.parent().hasClass('ui-front')) {
                    self.parent().addClass('ui-front');
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