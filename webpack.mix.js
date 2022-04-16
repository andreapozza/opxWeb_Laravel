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


mix.disableSuccessNotifications();

mix.js('resources/js/app.js', 'public/js')
    .alias({
        '@': 'resources/js',
        'ziggy': 'vendor/tightenco/ziggy/dist/vue'
    })
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ])
    .sass('resources/scss/app.scss', 'public/css')
    .sourceMaps();

mix.browserSync({
    proxy: 'localhost:8000',
    open: false
});