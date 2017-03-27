var gulp = require('gulp');
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

gulp.task("copyfiles", function () {
    gulp.src("vendor/bower_dl/jquery/dist/jquery.min.js")
        .pipe(gulp.dest("resources/assets/js"));

    gulp.src("vendor/bower_dl/bootstrap/less/**")
        .pipe(gulp.dest("resources/assets/less/bootstrap"));

    gulp.src("vendor/bower_dl/bootstrap/dist/js/bootstrap.min.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("vendor/bower_dl/bootstrap/dist/fonts/**")
        .pipe(gulp.dest("public/assets/fonts"));
});

elixir(function(mix) {
    mix.scripts(['js/jquery.min.js', 'js/bootstrap.min.js'],
        'public/assets/js/admin.js',
        'resources/assets');

    mix.less('admin.less', 'public/assets/css/admin.css');

    mix.sass('app.scss');
    //mix.phpUnit();
});
