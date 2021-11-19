+btn-primary({
    type: 'button', (required: false, default: 'button', type: String) - тип тега кнопки
    text: 'Primary', (required: true, default: undefined, type: String) - текст
    className: '', (required: false, default: '', type: String) - класс кнопки
    disabled: false, (required: false, default: false, type: Boolean) - блокирует доступ и изменение элемента
    outline: false (required: false, default: false, type: Boolean) - задать тип кнопки "outline"
})(
    attributes (required: false) - Стандартные pug-атрибуты тега
)