/* eslint-disable-next-line no-unused-vars */
function showPreloader(elem) {
    'use strict';

    if (elem === undefined) {
        var preloader = $('.preloader');
        if (preloader.length) {
            preloader.each(function() {
                $(this).addClass('active');
            });
        }
    } else if (elem.length) {
        elem.addClass('active');
    }
}

/* eslint-disable-next-line no-unused-vars */
function hidePreloader(elem) {
    'use strict';

    if (elem === undefined) {
        var preloader = $('.preloader');
        if (preloader.length) {
            preloader.each(function() {
                $(item).removeClass('active');
            });
        }
    } else if (elem.length) {
        elem.removeClass('active');
    }
}