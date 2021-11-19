!function () {
    'use strict';

    function hideSearch(search, searchField, timeout) {
        search.removeClass('active');
        searchField.trigger('blur');

        if(timeout !== undefined) {
            clearTimeout(timeout);
        }
    }

    function initSearch() {
        var search = $('.search-head-4');
        if (!search.length) {
            return false;
        }
        search.each(function () {
            var self = $(this);
            var backdrop = self.find('.backdrop');
            var searchField = self.find('.field');
            var openSearchBtn = self.find('.btn-open');
            var closeSearchBtn = self.find('.btn-close');
            if (!backdrop.length || !searchField.length || !openSearchBtn.length || !closeSearchBtn.length) {
                return false;
            }
            var timeout;
            openSearchBtn.off('click.search').on('click.search', function () {
                self.addClass('active');
                if ($('html').hasClass('ie') === true) {
                    timeout = setTimeout(function () {
                        searchField.trigger('focus');
                    }, 800);
                } else {
                    searchField.trigger('focus');
                }
            });
            closeSearchBtn.off('click.search').on('click.search', function () {
                hideSearch(self, searchField, timeout);
            });
            backdrop.off('click.search').on('click.search', function () {
                hideSearch(self, searchField, timeout);
            });
            $(window).on('resize', function () {
                hideSearch(self, searchField, timeout);
            });
        });
    }

    $(function () {
        initSearch();
    });
}();