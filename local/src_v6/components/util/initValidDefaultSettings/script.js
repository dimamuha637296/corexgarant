!function () {
    'use strict';

    // Form validation Default Settings
    var initValidDefaultSettings = {
        // Validation options http://jqueryvalidation.org/documentation/

        init: function () {
            if ($.fn.validate) {
                $.validator.setDefaults({
                    errorPlacement: function (error, element) {
                        error.appendTo(element.closest('.control-group').find('.controls'));
                    },
                    highlight: function (element) {
                        $(element).closest('.control-group').removeClass('has-success').addClass('has-error');
                    },
                    success: function (element) {// For valid OFF
                        element.closest('.control-group').removeClass('has-error');
                        element.remove();
                    }
                    //success: function(element) {// For valid ON
                    //    element.addClass('valid').closest('.control-group').removeClass('has-error').addClass('has-success');
                    //}
                });

                // Исправляем валидацию формата dd-mm-yyyy (работает dd-mm-yyyy, dd/mm/yyyy, dd.mm.yyyy)
                $.validator.addMethod(
                    'date',
                    function(value/*, element*/) {
                        // put your own logic here, this is just a (crappy) example
                        return value.match(/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/);
                    }// http://stackoverflow.com/questions/15491894/regex-to-validate-date-format-dd-mm-yyyy
                    //,"Please enter a date in the format dd/mm/yyyy."// Текст по умолчанию для ошибки
                );

                // Валидация для маски телефона
                $.validator.addMethod(
                    'requiredphone',
                    function (value) {
                        return value.replace(/\D+/g, '').length > 3;
                    },
                    'Заполните поле');
                $.validator.addMethod(
                    'minlengthphone',
                    function (value) {
                        return value.replace(/\D+/g, '').length > 11;
                    },
                    'Заполните номер телефона полностью');
            }
        }
    };

    $(function () {
        initValidDefaultSettings.init();
    });
}();