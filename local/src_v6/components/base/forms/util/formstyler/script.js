!function () {
    'use strict';

    function refreshModal() {
        $('.modal').on('shown.bs.modal', function (e) {
            $(e.currentTarget).find('.formstyler').trigger('refresh');
        });
    }

    function formSelect() {
        var input = $('.formstyler');
        if (input.length && $.fn.styler) {
            input.each(function() {
                var self = $(this);
                self.styler({
                    selectSearch: false,
                    selectVisibleOptions: 10,
                    selectPlaceholder: self.find('option').eq(0).text()
                });
            });
            refreshModal();
        }
    }

    $(function () {
        formSelect();
    });
}();