!function () {
    'use strict';

    // Определяем ОС
    function detectOS() {
        var OSName= 'Unknown';
        var navigatorAppVersion = navigator.appVersion;

        if (navigatorAppVersion.indexOf('Win') !== -1) {
            OSName = 'Windows';
        } else if (navigatorAppVersion.indexOf('Mac') !== -1) {
            OSName = 'Mac';
        } else if (navigatorAppVersion.indexOf('X11') !== -1) {
            if (navigatorAppVersion.indexOf('Linux') !== -1) {
                OSName = 'Linux';
            } else {
                OSName = 'UNIX';
            }
        } else if (navigatorAppVersion.indexOf('Linux') !== -1) {
            OSName = 'Linux';
        }
        $('html').addClass('os' + OSName);
    }

    // Call functions
    $(function () {
        detectOS();
    });
}();