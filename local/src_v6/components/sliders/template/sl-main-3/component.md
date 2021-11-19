+sl-main-3({
    modifer: 'type-1' {required: false, default: undefined, type: String} - Класс модификатора, который применяется к блоку слайдера
    pager: 'sl-pager', #{required: false, default: undefined, type: String} - Сслыка на компонент pager'a
    nav: 'sl-nav', #{required: false, default: undefined, type: String} - Сслыка на компонент nav
    slides: [ 
        {
            pic: 'pic', {required: true, default: null, type: String} - Картинка слайда
            title: 'title', {required: true, default: 'Заголовок слайда', type: String} - Заголовок слайда
            pagerTitle: 'text', {required: false, default: undefined, type: String} - Заголовок пейджера
            btnText: 'btnText' {required: false, default: undefined, type: String} - Текст кнопки
        }
    ] {required: true, default: null, type: Array} - Массив объектов, в котором каждый элемент слайд
  })