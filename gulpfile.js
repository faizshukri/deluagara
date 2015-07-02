var elixir = require('laravel-elixir');

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
    'markercluster' : './public/vendor/leaflet.markercluster'
};

elixir(function(mix) {
    mix
        .sass('app.scss')
        .styles(
            [
                paths.bootstrap + '/dist/css/bootstrap.min.css',
                paths.fontawesome + '/css/font-awesome.min.css',
                paths.markercluster + '/dist/MarkerCluster.css',
                paths.markercluster + '/dist/MarkerCluster.Default.css'
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
                '/assets/js/*'
            ],
            'public/js/vendor.js',
            './public'
        )
        .version(['css/app.css', 'css/vendor.css', 'js/vendor.js'])

        .copy(paths.fontawesome + '/fonts', 'public/fonts')
        .copy(paths.bootstrap + '/fonts', 'public/fonts')
});
