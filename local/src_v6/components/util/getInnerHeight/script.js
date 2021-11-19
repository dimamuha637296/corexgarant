// функция расчета высоты window в зависимости от браузера
// window.innerWidth = isIOs === true ? window(ширина без JQ) : window.innerWidth
/* eslint-disable-next-line no-unused-vars */
function getInnerHeight() {
    'use strict';
    var iOS = /Safari|iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream && !/Chrome/.test(navigator.userAgent);
    return (iOS) ? $(window).innerHeight() : window.innerHeight;
}