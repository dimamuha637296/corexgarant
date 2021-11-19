//Выпадающие блоки в header на мобильном
!function () {
    'use strict';

    var dropdownHeaderElement = {

        init: function () {
            var headerDropdown = $('.js-dropdown-full-width');
            if (headerDropdown.length && getInnerWidth() < ws.const.screen.grid_breakpoint_max) {
                headerDropdown.each(function(){
                    var self = $(this);
                    var toggler = self.find('.dropdown-toggle');
                    var tabLink = self.find('.nav-link');
                    if (tabLink) {
                        tabLink.on('click', function (e) {
                            e.stopPropagation();
                            $(this).tab('show');
                        });
                    }
                    toggler.dropdown({
                        display: 'static'
                    });
                    var headerDropdownMenu = $(this).find('.dropdown-menu');
                    var coord = self.offset();
                    headerDropdownMenu.css({'width': document.documentElement.clientWidth,  left: - coord.left});
                });
            }
        }
    };

    $(function () {
        dropdownHeaderElement.init();
    });

    $(window).on('resize', function () {
        dropdownHeaderElement.init();
    });
}();