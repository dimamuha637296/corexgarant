!function () {
    'use strict';

    // Global variables
    var oWindow = $(window);

    function _setSrc(opt, direct) {
        opt.btn[direct].on('click', function() {
            opt.img.each(function() {
                var self = $(this);
                self.prop('src', opt.name[direct]);
            });
        });
    }
    function createPanel() {
        var opt = {
            btn: {},
            context: $('#db'),
            name: {
                horiz: 'img/tmp/test-horizontal.jpg',
                vert: 'img/tmp/test-vertical.jpg'
            }
        };
        opt.body= $('body');
        if (!opt.body.length) {
            return false;
        }
        opt.html = '<div id="front-admin" class="front-admin">' +
                '<div class="btns">' +
                    '<button class="btn btn-xs btn-primary js-add-horiz" type="button">Горизонт изобр</button>' +
                    '<button class="btn btn-xs btn-primary js-add-vert" type="button">Верт изобр</button>' +
                    '<button class="btn btn-xs btn-primary js-add-text" type="button">Добавить текст</button>' +
                '</div>' +
            '</div>';
        opt.body.prepend(opt.html);
        opt.btn.horiz = $('.js-add-horiz');
        opt.btn.vert = $('.js-add-vert');
        opt.img = opt.context.find('img');
        if (!opt.img.length) {
            return false;
        }
        _setSrc(opt, 'horiz');
        _setSrc(opt, 'vert');
    }

    function _console(opt, text) {
        opt.logs.append('<p>' + text + '</p>');
    }
    function debugInfo() {
        var opt = {
            panel: $('#front-admin')
        };
        if (!opt.panel.length) {
            return false;
        }
        opt.html = '<div class="logs js-logs"></div>';
        opt.panel.append(opt.html);
        opt.logs = $('.js-logs');
        $(function () {
            _console(opt, 'DOM ready');
        });
        oWindow.on('load', function () {
            _console(opt, 'Window load');
        });
        oWindow.on('resize', function () {
            _console(opt, 'Window resize');
        });
        oWindow.on('scroll', function () {
            _console(opt, 'Window scroll');
        });
    }

    // Добавляем много текста во все текстовые блоки
    function addMoreText() {
        $('.js-add-text').on('click', function() {
            var textBlocks = $('div, li, td, p, span, a');
            textBlocks.each(function() {
                var self = $(this);
                if (self.children().length < 1) {
                    var text = self.text();
                    if (text.length > 0) {
                        self.text('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias asperiores autem nobis possimus quae quasi quisquam repellat similique voluptatibus? Illo iusto laboriosam neque quas quia! Distinctio eum nemo qui veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias asperiores autem nobis possimus quae quasi quisquam repellat similique voluptatibus? Illo iusto laboriosam neque quas quia! Distinctio eum nemo qui veniam.');
                    }
                }
            });
        });
    }

    // Call functions
    $(function () {
        createPanel();
        debugInfo();
        addMoreText();
    });
}();