+sl-advance({
    modifer: 'type-1' {required: false, default: undefined, type: String} - Класс модификатора, который применяется к блоку слайдера
    pager: 'sl-pager', #{required: false, default: undefined, type: String} - Сслыка на компонент pager'a
    nav: 'sl-nav', #{required: false, default: undefined, type: String} - Сслыка на компонент nav
    title: 'title', {required: true, default: 'Заголовок слайда', type: String} - Заголовок слайдера
    btnText: 'btnText' {required: false, default: undefined, type: String} - Текст кнопки
    slides: [ 
        {
            pic: 'pic', {required: true, default: null, type: String} - Картинка слайда
            title: 'title', {required: true, default: 'Заголовок слайда', type: String} - Заголовок слайда
            value: '50', {required: false, default: undefined, type: String} - Число в слайде
            text: 'text' {required: false, default: undefined, type: String} - Текст слайда
        }
    ] {required: true, default: null, type: Array} - Массив объектов, в котором каждый элемент слайд
  })