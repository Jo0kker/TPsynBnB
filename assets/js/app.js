const $ = require('jquery');
global.$ = global.jQuery = $;
require('popper.js');
require('./bootstrap.min.js');
console.log('Hello Webpack Encore');