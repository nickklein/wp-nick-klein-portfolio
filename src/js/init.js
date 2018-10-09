global.$ = global.jQuery = require('jquery');

var globaljs = require('./modules/global');
var headerjs = require('./modules/header');
var expertisejs = require('./modules/expertise');
//var footerjs = require('./modules/footer');

globaljs.init();
headerjs.init();
expertisejs.init();
//footerjs.init();