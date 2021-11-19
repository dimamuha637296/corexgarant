!function () {
    'use strict';
    var contactsHead2 = {

        replacePhones: function() {
            var tels = this.block.find('.tel');
            tels.hide();
            var cityNumber = this.self.find('.text').data('city');
            tels.filter('[data-city="' + cityNumber + '"]').show();
        },

        replaceText: function() {
            var oldCity = this.block.find('.drop-link');
            var oldCityHtml = oldCity.html();
            var newCity = this.self;
            var newCityHtml = newCity.html();
            oldCity.html(newCityHtml);
            newCity.html(oldCityHtml);
        },

        clickHandler: function() {
            this.replacePhones();
            this.replaceText();
        },

        setClickHandler: function() {
            this.link.on('click', function() {
                contactsHead2.self = $(this);
                contactsHead2.clickHandler();
                return false;
            });
        },

        init: function () {
            this.block = $('.contacts-head-2');
            if (!this.block.length) {
                return false;
            }
            this.link = this.block.find('.submenu').find('.item');
            if (!this.link.length) {
                return false;
            }
            this.self = this.block.find('.drop-link');
            this.clickHandler();
            this.setClickHandler();
        }
    };

    $(function () {
        contactsHead2.init();
    });
}();