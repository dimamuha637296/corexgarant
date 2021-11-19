!function() {
    'use strict';

    // парсит таблицу и добавляет к каждой ячейке, соответствующий ей заголовок, который показывается на xs-разрешении
    function sortTable() {
        var block = $('.js-sort-table table');
        if (!block.length) {
            return false;
        }
        block.each(function () {
            var currTable = $(this);
            var tbody = currTable.find('tbody');
            currTable.find('th').each(function (i) {
                var currHeadCell = $(this).text();
                tbody.find('tr').each(function () {
                    $(this).find('td').eq(i).each(function () {
                        var currCell = $(this);
                        if (!currCell.children().hasClass('.table-cell-content')) {
                            var currCellHtml = currCell.html();
                            currCell.html('<div class="table-cell-label">' + currHeadCell + '</div>' +
                                '<div class="table-cell-content">' + currCellHtml + '</div>');
                        }
                    });
                });
            });
        });
    }

    $(function() {
        sortTable();
    });
}();