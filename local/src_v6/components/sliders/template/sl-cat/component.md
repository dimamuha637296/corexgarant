+sl-cat({
    modifer: 'type-1' {required: false, default: undefined, type: String} - Класс модификатора, который применяется к блоку слайдера
    pager: 'sl-pager', #{required: false, default: undefined, type: String} - Сслыка на компонент pager'a
    nav: 'sl-nav', #{required: false, default: undefined, type: String} - Сслыка на компонент nav
    slides: [ 
        {
            pic: 'pic', {required: true, default: null, type: String} - Картинка слайда
            title: 'title', {required: true, default: 'Заголовок слайда', type: String} - Заголовок слайда
            text: 'text', {required: false, default: undefined, type: String} - Текст слайда
            btnText: 'btnText' {required: false, default: undefined, type: String} - Текст кнопки
            product: 'товаров', {required: true, default: null, type: String} - Подпись после цифры кол-ва товаров
            productQuant: '256', {required: true, default: null, type: String} - Кол-во товаров
            icon: 'laminate-cat-ic--big.png', {required: true, default: null, type: String} - Иконка товара
            active: true {required: false, default: false, type: Boolean} - Активный ли слайд
        }
    ] {required: true, default: null, type: Array} - Массив объектов, в котором каждый элемент слайд
  })