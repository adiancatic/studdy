const mix = require('laravel-mix');
const {copy} = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/app.js', 'public/js')
    .sass('resources/scss/app.scss', 'public/css')
    .copy('resources/plugins/fontawesome/css/all.min.css', 'public/css')
    .copyDirectory('resources/plugins/fontawesome/webfonts', 'public/webfonts')
    ;
