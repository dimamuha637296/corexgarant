/* eslint-disable-next-line no-unused-vars */
var fullWrap = {

    /**
     * Растягивает блок на всю ширину контентной области.
     */

    init: function(slBlock) {
        'use strict';

        var $window = $(window);

        function fullWrap(slBlock) {
            var wrap = slBlock.find('.full-wrap');
            if (wrap.length) {
                wrap.css({
                    'width': $('.g-main').outerWidth()
                });
            }
        }

        $window.on('resize', function () {
            fullWrap(slBlock);
        });

        $window.on('load', function () {
            fullWrap(slBlock);
        });
    }
};