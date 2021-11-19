+sl-project({
    modifer: 'type-1' {required: false, default: undefined, type: String} - Класс модификатора, который применяется к блоку слайдера
    pager: 'sl-pager', #{required: false, default: undefined, type: String} - Сслыка на компонент pager'a
    nav: 'sl-nav', #{required: false, default: undefined, type: String} - Сслыка на компонент nav
    slides: [ 
        {
            pic: 'pic', {required: true, default: null, type: String} - Картинка слайда
            title: 'title', {required: true, default: 'Заголовок слайда', type: String} - Заголовок слайда
            listInfo: [
                name: 'Название', {required: false, default: null, type: String} - Название элемента списка
                descr: 'Описание', {required: false, default: null, type: String} - Описание элемента списка
            ] {required: true, default: null, type: Array} - Массив объектов,формирующий список параметров в слайде
        }
    ] {required: true, default: null, type: Array} - Массив объектов, в котором каждый элемент слайд
  })