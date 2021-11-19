/* Файл инициализации настроек тестирования
*
* Порядок следования файлов:
* before.js
* Динамически подключаемые компоненты
* after.js
*/

// Выключаем всю анимацию
var disableAnimationStyles = '-webkit-transition: none !important;' +
    '-moz-transition: none !important;' +
    '-ms-transition: none !important;' +
    '-o-transition: none !important;' +
    'transition: none !important;';
window.onload = function() {
    var animationStyles = document.createElement('style');
    animationStyles.type = 'text/css';
    animationStyles.innerHTML = '* {' + disableAnimationStyles + '};' +
        '.ws-pages {display: none;}';// Выключаем отображение списка страниц
    document.head.appendChild(animationStyles);
};

// ToDo components/header/menu-base/menu-base/test.js:6 - не wait, а отключение анимации jQuery ЛИБО создание отдельной страницы со включенным menu-base
// var disableAnimationJQuery = '$.fx.off = true;';
// window.onload = function() {
//     var animationStyles = document.createElement('script');
//     animationStyles.innerHTML = disableAnimationJQuery;
//     document.head.appendChild(animationStyles);
// };

// Инициализация настроек phantomcss
phantomcss.init({
    // https://github.com/Huddle/PhantomCSS
    /*
     Don't add count number to images. If set to false, a filename is
     required when capturing screenshots.
     */
    addIteratorToImage: false,
    onPass: function(test) {
        //console.log(test.filename);
    },
    onFail: function(test) {
        // console.log(test.filename, test.mismatch);
    },
    onComplete: function(allTests, noOfFails, noOfErrors) {
        if (noOfFails === 0 && noOfErrors === 0) {
            console.log('It\'s OK!');
        } else {
            allTests.forEach(function(test) {
                if (test.fail) {
                    console.log('Failed: ' + test.filename + ', разница ' + test.mismatch + '%');
                }
            });
        }
    }
});

// Режим сравнения
phantom.casperTest = true;

// http://casperjs.org/
// http://docs.casperjs.org/en/latest/modules/casper.html#visible
// http://docs.casperjs.org/en/latest/modules/casper.html
// http://docs.casperjs.org/en/latest/modules/casper.html#wait

casper.start('http://localhost:3000/index.html');
