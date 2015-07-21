var elixir = require('laravel-elixir');
require("./resources/assets/js/elixir-ext");

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var paths = {
    'jquery'        : './public/vendor/jquery',
    'bootstrap'     : './public/vendor/bootstrap',
    'fontawesome'   : './public/vendor/fontawesome',
    'mapbox'        : './public/vendor/mapbox.js',
    'markercluster' : './public/vendor/leaflet.markercluster',
    'others'        : './public/vendor/others',
    'select2'       : './public/vendor/select2',
    'select2_bootstrap_theme' : './public/vendor/select2-bootstrap-theme'
};

var urls = {
    'bootstrap_yeti': 'https://bootswatch.com/yeti/bootstrap.min.css'
};

elixir(function(mix) {
    mix
        .sass('app.scss')
        .download(urls.bootstrap_yeti, paths.others)
        .styles(
            [
                paths.others + '/bootstrap.min.css',
                paths.fontawesome + '/css/font-awesome.min.css',
                paths.markercluster + '/dist/MarkerCluster.css',
                paths.markercluster + '/dist/MarkerCluster.Default.css',
                paths.select2 + '/dist/css/select2.min.css',
                paths.select2_bootstrap_theme + '/dist/select2-bootstrap.min.css'
            ],
            'public/css/vendor.css',
            './public'
        )
        .scripts(
            [
                paths.jquery + '/dist/jquery.min.js',
                paths.bootstrap + '/dist/js/bootstrap.min.js',
                paths.mapbox + '/mapbox.js',
                paths.markercluster + '/dist/leaflet.markercluster.js',
                paths.select2 + '/dist/js/select2.min.js',
                '/assets/js/*'
            ],
            'public/js/vendor.js',
            './public'
        )
        .version(['css/app.css', 'css/vendor.css', 'js/vendor.js'])

        .copy(paths.fontawesome + '/fonts', 'public/build/fonts')
        .copy(paths.bootstrap + '/fonts', 'public/build/fonts')
        .copy(paths.select2 + '/*.png', 'public/build/css')
        .copy(paths.select2 + '/*.gif', 'public/build/css')
});
