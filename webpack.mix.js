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
mix.js('resources/js/modal/NewModalManager.js', 'public/js/modal');

mix.js('resources/js/SearchableDropdown.js', 'public/js');

mix.js('resources/js/app.js', 'public/js')
    // .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .vue();

mix.js('resources/js/components/dynamic-table/dynamic-table.js', 'public/js/components/dynamic-table/dynamic-table.js')
    .sourceMaps();

mix.css('resources/css/dynamic-table.css', 'public/css')
    .sourceMaps()
    .disableNotifications();

mix.js('resources/js/org-chart-filter.js', 'public/js')
   .version();

// If you need to support older browsers
mix.babel('public/js/org-chart-filter.js', 'public/js/org-chart-filter.es5.js');

// Copy static JSON/config and small helper scripts used at runtime to public
mix.copyDirectory('resources/js/config', 'public/js/config');
// If you maintain an `org-structure` helper folder in resources, copy it too

// Production optimizations
if (mix.inProduction()) {
    mix.minify('public/js/org-chart-filter.js');
}
