!function () {
    'use strict';

    var setCounterReset = {

        init: function () {
            var lists = $('.g-wrap ol');
            if (!lists.length) {
                return false;
            }
            lists.each(function () {
                var self = $(this);
                if (!self.hasClass('list-reset')) {
                    var startValue = self.attr('start');
                    if ($.isNumeric(startValue)) {
                        self.css({
                            'counter-reset': 'list ' + (startValue - 1)
                        });
                    }
                }
            });
        }
    };

    $(function () {
        setCounterReset.init();
    });
}();