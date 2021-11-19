+sl-prod({
    modifer: 'type-1' {required: false, default: undefined, type: String} - Класс модификатора, который применяется к блоку слайдера
    slides: [ 
        {
            pic: 'pic', {required: true, default: null, type: String} - Картинка слайда
        }
    ] {required: true, default: null, type: Array} - Массив объектов, в котором каждый элемент слайд
  })