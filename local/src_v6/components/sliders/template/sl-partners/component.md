+sl-partners({
    bTitle: {} {required: false, default: undefined, type: Object} - Объект, который передаётся в компонент b-title
    modifer: 'type-1' {required: false, default: undefined, type: String} - Класс модификатора, который применяется к блоку слайдера
    pager: 'sl-pager', #{required: false, default: undefined, type: String} - Сслыка на компонент pager'a
    nav: 'sl-nav-2', #{required: false, default: undefined, type: String} - Сслыка на компонент nav
    bg: 'bg', #{required: false, default: undefined, type: String} - Фон слайдера
    slides: [ 
      'sl-partners-1.jpg', #{required: true, default: null, type: String} - Ссылка на картинку слайда
      'sl-partners-2.jpg',
      'sl-partners-3.jpg'
    ] {required: true, default: null, type: Array} - Массив, в котором каждый элемент слайд
  })