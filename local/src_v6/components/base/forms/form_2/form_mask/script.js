!function () {
    'use strict';
    function initMaskTel() {
        var masked = $('.js_mask_tel_2');
        if (masked.length && $.fn.mask) {
            masked.each(function() {
                $(this).mask(
                    '+375-(99)-999-99-99',
                    {
                        placeholder: '+375-(__)-___-__-__'
                    }
                );
            });
        }
    }

    $(function () {
        initMaskTel();
    });
}();