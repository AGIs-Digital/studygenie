const mix = require('laravel-mix');

mix.js('resources/js/app.js')
   .sass('resources/sass/app.scss')
   .version();

if (!mix.inProduction()) {
    mix.sourceMaps();
}
