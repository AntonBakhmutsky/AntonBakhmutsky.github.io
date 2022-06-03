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

mix.js('resources/admin/js/app.js', 'public/js/admin.js')
  .postCss('resources/admin/css/app.css', 'public/css/admin.css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
  ])
  .js('resources/src/scripts/main.js', 'public/js')
  .js('resources/src/scripts/map.js', 'public/js')
  .sass('resources/src/styles/app.sass', 'public/css')
  .copyDirectory('resources/src/assets', 'public/assets')
  .version();
;
