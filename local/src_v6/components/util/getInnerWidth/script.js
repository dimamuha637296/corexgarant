// функция расчета ширины window в зависимости от браузера
//Chrome has both 'Chrome' and 'Safari' inside userAgent string. Safari has only 'Safari'
/* eslint-disable-next-line no-unused-vars */
function getInnerWidth() {
    'use strict';
    var iOS = /Safari|iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream && !/Chrome/.test(navigator.userAgent);
    return (iOS) ? $(window).innerWidth() : window.innerWidth;
}