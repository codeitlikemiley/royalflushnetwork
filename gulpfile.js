var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.scripts([
    'vendor/jquery.min.js',
    'vendor/materialize.min.js',
    'vendor/jquery-ui.min.js',
    'vendor/jquery-jNewsbar.min.js',
    'vendor/jquery-timeago.min.js',
    'vendor/livequery.min.js',
    'vendor/socket.io.min.js',
    ],'public/js/vendor.js');
});
