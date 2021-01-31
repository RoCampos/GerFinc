const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

mix.copy('node_modules/bootstrap-datepicker-1/css/bootstrap-datepicker.min.css', 'public/vendor/bootstrap-datepicker/css');
mix.copy('node_modules/bootstrap-datepicker-1/js/bootstrap-datepicker.min.js', 'public/vendor/bootstrap-datepicker/js');
mix.copy('node_modules/bootstrap-datepicker-1/locales/bootstrap-datepicker.pt-BR.min.js', 'public/vendor/bootstrap-datepicker/locales');
