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
    'jquery':      './resources/components/jquery',
    'bootstrap':   './resources/components/bootstrap',
    'fontawesome': './resources/components/fontawesome'
}

elixir(function(mix) {
    mix
        .sass('app.scss')
        .styles(
            [
                '../public/css/app.css',
                paths.bootstrap + '/dist/css/bootstrap.min.css',
                paths.fontawesome + '/css/font-awesome.min.css'
            ],
            'public/css/app.css',
            './resources'
        )
        .scripts(
            [
                paths.jquery + '/dist/jquery.min.js',
                paths.bootstrap + '/dist/js/bootstrap.min.js',
                '/assets/js/*'
            ],
            'public/js/app.js',
            './resources'
        )
        .version(['css/app.css', 'js/app.js'])

        .copy(paths.fontawesome + '/fonts', 'public/fonts')
        .copy(paths.bootstrap + '/fonts', 'public/fonts')
});
