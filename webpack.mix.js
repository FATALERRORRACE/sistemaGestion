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

mix
.js('resources/js/login.js', 'public/js')
.js('resources/js/app.js', 'public/js')
.js('resources/js/home.js', 'public/js')
.js('resources/js/btnActions.js', 'public/js')
//.postCss('resources/js/gridjs/mermaid.min.css', 'public/gridjs', [])
.postCss('resources/css/app.css', 'public/css', [])
.postCss('resources/css/customResources.css', 'public/css', []);
