const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
mix.copy('node_modules/toastr/toastr.js', 'public/js');
mix.copy('node_modules/ion-rangeslider/js/ion.rangeSlider.js', 'public/js');
mix.copy('node_modules/multiselect/js/jquery.multi-select.js', 'public/js');