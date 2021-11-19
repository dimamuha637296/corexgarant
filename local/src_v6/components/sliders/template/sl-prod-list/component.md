+sl-prod-list({
    bTitle: {} {required: false, default: undefined, type: Object} - Объект, который передаётся в компонент b-title
    modifer: 'type-1' {required: false, default: undefined, type: String} - Класс модификатора, который применяется к блоку слайдера
    pager: 'sl-pager', #{required: false, default: undefined, type: String} - Сслыка на компонент pager'a
    nav: 'sl-nav', #{required: false, default: undefined, type: String} - Сслыка на компонент nav
    navTop: true, #{required: false, default: undefined, type: String} - Должны ли быть стрелки навигации вверху
    slides: [ 
        {
            pic: 'pic', {required: true, default: null, type: String} - Картинка слайда
            title: 'title', {required: true, default: 'Заголовок слайда', type: String} - Заголовок слайда
        }
    ] {required: true, default: null, type: Array} - Массив объектов, в котором каждый элемент слайд
  })