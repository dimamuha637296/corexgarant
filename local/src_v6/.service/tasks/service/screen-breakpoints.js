'use strict';

module.exports = function (opt) {

    opt.gulp.task('addScreenBreakPoints', function () {
        var objResult = {};
        var arScreens = [
            '$screen-xs-min',
            '$screen-sm-min',
            '$screen-md-min',
            '$screen-lg-min',
            '$screen-xl-min',
            '$grid-breakpoint-min',
            '$container-xs',
            '$container-sm',
            '$container-md',
            '$container-lg',
            '$container-xl'
        ];

        // Получаем значения переменных arScreens из SCSS переменных
        arScreens.map(function(item) {
            var name = item.replace(/-/g, '_').replace(/\$/g, '');
            var value = opt.sassVars[item];
            if (value !== undefined) {
                value = value.match(/^[^\d]*(\d+)/g)[0]; // https://www.regextester.com/?fam=106746
            }
            objResult[name] = value;
        });

        // Set max-width for breakpoints
        objResult.screen_xs_max = (objResult.screen_sm_min - .02);
        objResult.screen_sm_max = (objResult.screen_md_min - .02);
        objResult.screen_md_max = (objResult.screen_lg_min - .02);
        objResult.screen_lg_max = (objResult.screen_xl_min - .02);
        objResult.grid_breakpoint_max = (objResult.grid_breakpoint_min - .02);
        objResult.screen_xl_max = undefined;

        var iterator = 0;
        var objLength = Object.keys(objResult).length;
        var script =
            'ws.const.screen = {\n';
                for (var key in objResult) {
                    iterator++;
                    script += ' ' + key + ': ' + objResult[key] + (iterator >= objLength ? '' : ',') + '\n';
                }
            script +=
                '};';

        opt.fs.writeFileSync('./core/util/ws_screen/script.js', script);
    });
};