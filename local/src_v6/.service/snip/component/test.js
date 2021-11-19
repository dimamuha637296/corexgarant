casper.thenOpen('http://localhost:3000/index.html')
    .then(function () {
        if (casper.visible('#test-header')) {
            phantomcss.screenshot('#test-header', 'g-header-lg');
        }
        if (casper.visible('.g-header_mob-fixed')) {
            phantomcss.screenshot('.g-header_mob-fixed', 'g-header-fixed-xs');
        }
    });
casper.thenOpen('http://localhost:3000/test-header-1.html')
    .then(function () {
        if (casper.visible('.g-header-fixed')) {
            phantomcss.screenshot('.g-header-fixed', 'g-header-fixed-lg');
        }
    });
casper.thenOpen('http://localhost:3000/test-header-2.html')
    .then(function () {
        if (casper.visible('.g-header-fixed')) {
            phantomcss.screenshot('.g-header-fixed', 'g-header-fixed-2-lg');
        }
    });
casper.thenOpen('http://localhost:3000/test-search-open.html')
    .then(function () {
        if (casper.visible('.head-wrap')) {
            phantomcss.screenshot('.search-in', 'search-open');
        }
    });