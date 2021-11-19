!function () {
    'use strict';

    // В табах, если нет ни одного активного класса, по умолчанию ставится первый активным
    var tabIniter = {

        init: function () {
            var target = $('.nav-tabs');
            if (!target.length) {
                return false;
            }
            target.each(function () {
                var items = $(this).children('li');
                var hasClass = false;
                items.each(function () {
                    if ($(this).hasClass('active')) {
                        hasClass = true;
                        return false;
                    }
                });
                if (hasClass === false) {
                    items.eq(0).children(['data-toggle']).tab('show');
                }
            });
        }
    };

    $(function () {
        tabIniter.init();
    });
}();