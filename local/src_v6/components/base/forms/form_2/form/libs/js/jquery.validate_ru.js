$.validator.messages = {
    required: "Заполните поле",
    remote: "Исправьте поля",
    email: "Некорректный e-mail",
    url: "Введите корректный URL",
    date: "Введите правильную дату",
    dateISO: "Введите правильную дату ( ISO )",
    number: "Введите корректный номер",
    digits: "Введите только цифры",
    creditcard: "Введите корректный номер кредитной карты",
    equalTo: "Поля не совпадают",
    maxlength: $.validator.format( "Максимум {0} символов" ),
    minlength: $.validator.format( "Минимум {0} символов" ),
    rangelength: $.validator.format( "Введите значение длиной от {0} до {1} символов" ),
    range: $.validator.format( "Введите значение между {0} и {1}" ),
    max: $.validator.format( "Максимум {0}" ),
    min: $.validator.format( "Минимум {0}" )
};