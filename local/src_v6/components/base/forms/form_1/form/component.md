+form_1({
  formID: 'formID' (required: true, default: null, type: String) - ID
  method: 'post' (required: false, default: 'post', type: String) - Метод протокола HTTP
  action: '/' (required: false, default: '/', type: String) - Адрес программы или документа, который обрабатывает данные формы
  requiredText: 'обязательно к заполнению' (required: false, default: '- поля обязательные к заполнению', type: String) - Текст-подсказка об наличии обязательных полей
  hasValidation: true (required: false, default: false, type: Boolean) - Включать ли правила валидации
  dropdownValidation: false (required: false, default: false, type: Boolean) - Включать ли валидацию вопросиком
  validOnlyRequired: false (required: false, default: false, type: Boolean) - Валидировать только required поля формы
  hasCaptcha: true (required: false, default: false, type: Boolean) - Есть ли в форме капча
  captchaLabel: 'Введите капчу' (required: false, default: 'Введите символы с картинки', type: String) - Текст лейбла капчи
  submitBtnClass: 'btn-primary' (required: false, default: 'btn-default btn_submit', type: String) - Класс кнопки отправки
  submitBtnText: 'Отправить запрос' (required: false, default: 'Отправить', type: String) - Текст кнопки отправки
  labelCol: 'col-xl-2 col-md-3 col-12' (required: false, default: 'col-xl-2 col-md-3 col-12', type: String) - Классы колонок лейбла
  inputCol: 'col-xl-6 col-md-5 col-12' (required: false, default: 'col-xl-6 col-md-5 col-12', type: String) - Классы колонок ипнута
  controlCol: 'col-md-4 col-12' (required: false, default: 'col-md-4 col-12', type: String) - Классы колонок результата валидации
  rows: [// Состав строк формы
      // Input
      {
          labelText: 'Ваше имя' (required: false, default: '', type: String) - Текст лейбла
          type: 'email' (required: false, default: 'text', type: String) - К какому типу относится элемент формы
          id: formID + '-FIO' (required: true, default: null, type: String) - ID
          className: '' (required: false, default: 'form-control', type: String) - Класс
          name: formID + '-FIO' (required: false, default: null, type: String) - Имя поля
          value: 'text' (required: false, default: '', type: String) - Значение элемента
          placeholder: 'email@example.com' (required: false, default: null, type: String) - Выводит подсказывающий текст
          maxlength: 100 (required: false, default: 100, type: Number) - Максимальное количество символов разрешённых в тексте
          minlength: 2 (required: false, default: null, type: Number) - Минимальное количество символов разрешённых в тексте
          max: 100 (required: false, default: null, type: Number) - Верхнее значение для ввода числа или даты
          min: 2 (required: false, default: null, type: Number) - Нижнее значение для ввода числа или даты
          spellcheck: true (required: false, default: false, type: Boolean) - Проверять или нет правописание и грамматику в тексте
          required: true (required: false, default: false, type: Boolean) - Обязательное для заполнения поле
          disabled: false (required: false, default: false, type: Boolean) - Блокирует доступ и изменение элемента
          labelCol: 'col-xl-2 col-md-3 col-12' (required: false, default: 'col-xl-2 col-md-3 col-12', type: String) - Классы колонок лейбла
          inputCol: 'col-xl-6 col-md-5 col-12' (required: false, default: 'col-xl-6 col-md-5 col-12', type: String) - Классы колонок ипнута
          controlCol: 'col-md-4 col-12' (required: false, default: 'col-md-4 col-12', type: String) - Классы колонок результата валидации
      }

      // Select
      {
          labelText: 'Ваше имя' (required: false, default: '', type: String) - Текст лейбла
          controlType: 'select'
          id: formID + '-FIO' (required: true, default: null, type: String) - ID
          className: '' (required: false, default: 'form-control', type: String) - Класс
          name: formID + '-FIO' (required: false, default: null, type: String) - Имя поля
          required: true (required: false, default: false, type: Boolean) - Обязательное для заполнения поле
          disabled: false (required: false, default: false, type: Boolean) - Блокирует доступ и изменение элемента
          labelCol: 'col-xl-2 col-md-3 col-12' (required: false, default: 'col-xl-2 col-md-3 col-12', type: String) - Классы колонок лейбла
          inputCol: 'col-xl-6 col-md-5 col-12' (required: false, default: 'col-xl-6 col-md-5 col-12', type: String) - Классы колонок ипнута
          controlCol: 'col-md-4 col-12' (required: false, default: 'col-md-4 col-12', type: String) - Классы колонок результата валидации
          list: [
              {
                  text: 'text' (required: true, default: '', type: String) - Текст элемента
                  value: 'text' (required: false, default: '', type: String) - Значение элемента
                  selected: false (required: false, default: false, type: Boolean) - Выбран ли option
                  disabled: false (required: false, default: false, type: Boolean) - Блокирует доступ и изменение элемента
              }
          ] (required: true, default: [], type: Array) - Список из option
      }

      // Textarea
      {
          labelText: 'Ваше имя' (required: false, default: '', type: String) - Текст лейбла
          controlType: 'textarea'
          id: formID + '-FIO' (required: true, default: null, type: String) - ID
          className: '' (required: false, default: 'form-control', type: String) - Класс
          name: formID + '-FIO' (required: false, default: null, type: String) - Имя поля
          placeholder: 'email@example.com' (required: false, default: null, type: String) - Выводит подсказывающий текст
          maxlength: 100 (required: false, default: 100, type: Number) - Максимальное количество символов разрешённых в тексте
          minlength: 2 (required: false, default: null, type: Number) - Минимальное количество символов разрешённых в тексте
          spellcheck: true (required: false, default: false, type: Boolean) - Проверять или нет правописание и грамматику в тексте
          rows: 6 (required: false, default: null, type: Number) - Кол-во строк
          cols: 10 (required: false, default: null, type: Number) - Кол-во столбцов
          required: true (required: false, default: false, type: Boolean) - Обязательное для заполнения поле
          disabled: false (required: false, default: false, type: Boolean) - Блокирует доступ и изменение элемента
          labelCol: 'col-xl-2 col-md-3 col-12' (required: false, default: 'col-xl-2 col-md-3 col-12', type: String) - Классы колонок лейбла
          inputCol: 'col-xl-6 col-md-5 col-12' (required: false, default: 'col-xl-6 col-md-5 col-12', type: String) - Классы колонок ипнута
          controlCol: 'col-md-4 col-12' (required: false, default: 'col-md-4 col-12', type: String) - Классы колонок результата валидации
      }

      // Datepicker
      {
          labelText: 'Ваше имя' (required: false, default: '', type: String) - Текст лейбла
          controlType: 'datepicker'
          id: formID + '-FIO' (required: true, default: null, type: String) - ID
          className: '' (required: false, default: 'form-control', type: String) - Класс
          name: formID + '-FIO' (required: false, default: null, type: String) - Имя поля
          placeholder: 'email@example.com' (required: false, default: null, type: String) - Выводит подсказывающий текст
          required: true (required: false, default: false, type: Boolean) - Обязательное для заполнения поле
          disabled: false (required: false, default: false, type: Boolean) - Блокирует доступ и изменение элемента
          labelCol: 'col-xl-2 col-md-3 col-12' (required: false, default: 'col-xl-2 col-md-3 col-12', type: String) - Классы колонок лейбла
          inputCol: 'col-xl-6 col-md-5 col-12' (required: false, default: 'col-xl-6 col-md-5 col-12', type: String) - Классы колонок ипнута
          controlCol: 'col-md-4 col-12' (required: false, default: 'col-md-4 col-12', type: String) - Классы колонок результата валидации
      }

      // Checkbox / Radio
      {
          labelText: 'Ваше имя' (required: false, default: '', type: String) - Текст лейбла
          controlType: 'checkbox / radio'
          id: formID + '-FIO' (required: true, default: null, type: String) - ID
          className: '' (required: false, default: 'form-control', type: String) - Класс
          name: formID + '-FIO' (required: false, default: null, type: String) - Имя поля
          value: 'text' (required: false, default: '', type: String) - Значение элемента
          required: true (required: false, default: false, type: Boolean) - Обязательное для заполнения поле
          disabled: false (required: false, default: false, type: Boolean) - Блокирует доступ и изменение элемента
          checked: false (required: false, default: false, type: Boolean) - Выбран ли элемент
          text: 'Текст чекбокса/радио' (required: false, default: false, type: String) - Текст чекбокса/радио
          labelCol: 'col-xl-2 col-md-3 col-12' (required: false, default: 'col-xl-2 col-md-3 col-12', type: String) - Классы колонок лейбла
          inputCol: 'col-xl-6 col-md-5 col-12' (required: false, default: 'col-xl-6 col-md-5 col-12', type: String) - Классы колонок ипнута
          controlCol: 'col-md-4 col-12' (required: false, default: 'col-md-4 col-12', type: String) - Классы колонок результата валидации
      }

      // Checkbox Group / Radio Group
      {
          labelText: 'Ваше имя' (required: false, default: '', type: String) - Текст лейбла
          name: formID + '-FIO' (required: false, default: null, type: String) - Имя поля
          list: [] (required: true, default: [], type: Array) - Список из checkbox/radio (cм. вышле)
          labelCol: 'col-xl-2 col-md-3 col-12' (required: false, default: 'col-xl-2 col-md-3 col-12', type: String) - Классы колонок лейбла
          inputCol: 'col-xl-6 col-md-5 col-12' (required: false, default: 'col-xl-6 col-md-5 col-12', type: String) - Классы колонок ипнута
          controlCol: 'col-md-4 col-12' (required: false, default: 'col-md-4 col-12', type: String) - Классы колонок результата валидации
      }
      
      // File
      {
          controlType: 'file',
          labelText: 'Ваше имя' (required: false, default: '', type: String) - Текст лейбла
          type: 'email' (required: false, default: 'text', type: String) - К какому типу относится элемент формы
          id: formID + '-FIO' (required: true, default: null, type: String) - ID
          className: '' (required: false, default: 'form-control', type: String) - Класс
          name: formID + '-FIO' (required: false, default: null, type: String) - Имя поля
          max: 100 (required: false, default: null, type: Number) - Верхнее значение для ввода числа или даты
          min: 2 (required: false, default: null, type: Number) - Нижнее значение для ввода числа или даты
          required: true (required: false, default: false, type: Boolean) - Обязательное для заполнения поле
          disabled: false (required: false, default: false, type: Boolean) - Блокирует доступ и изменение элемента
          labelCol: 'col-xl-2 col-md-3 col-12' (required: false, default: 'col-xl-2 col-md-3 col-12', type: String) - Классы колонок лейбла
          inputCol: 'col-xl-6 col-md-5 col-12' (required: false, default: 'col-xl-6 col-md-5 col-12', type: String) - Классы колонок ипнута
          controlCol: 'col-md-4 col-12' (required: false, default: 'col-md-4 col-12', type: String) - Классы колонок результата валидации
      }
      
      // Webform field upload
      {
          controlType: 'webformFieldUpload',
          labelText: 'Ваше имя' (required: false, default: '', type: String) - Текст лейбла
          labelCol: 'col-xl-2 col-md-3 col-12' (required: false, default: 'col-xl-2 col-md-3 col-12', type: String) - Классы колонок лейбла
          inputCol: 'col-xl-6 col-md-5 col-12' (required: false, default: 'col-xl-6 col-md-5 col-12', type: String) - Классы колонок ипнута
          controlCol: 'col-md-4 col-12' (required: false, default: 'col-md-4 col-12', type: String) - Классы колонок результата валидации
      }
  ]
})  