const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').sourceMaps()
    .js('resources/js/calendar.js', 'public/js').sourceMaps()
    .js('resources/js/planList_ajax.js', 'public/js').sourceMaps()
    .js('resources/js/home.js', 'public/js').sourceMaps()
    .js('resources/js/swipe.js', 'public/js').sourceMaps()
    .js('resources/js/balloonAnimation.js', 'public/js').sourceMaps()
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/style.scss', 'public/css')
    .sass('resources/sass/homeStyle.scss', 'public/css')
    .sass('resources/sass/auth_style.scss', 'public/css')
    .sass('resources/sass/balloonStyle.scss', 'public/css');
