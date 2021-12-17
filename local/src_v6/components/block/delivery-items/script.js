!function () {
    'use strict';

    function toFavorites() {
        var block = $('.delivery-items');
        if (block.length) {
            var btn = block.find('.delivery-items__btn');
            btn.each(function () {
                var self = $(this);

                self.off('click.block').on('click.block', function(e) {
                    e.preventDefault();
                    $(this).closest('.delivery-items').find('.delivery-items__btn').each(function () {
                        $(this).removeClass('active');
                        $(this).siblings('input').prop('checked', false);
                    });
                    $(this).addClass('active');
                    $(this).siblings('input').prop('checked', true);
                });
            });
        }
    }

    $(function () {
        toFavorites();
    });
}();
