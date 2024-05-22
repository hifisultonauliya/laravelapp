const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .vue();

if (mix.inProduction()) {
    mix.version();
} else {
    mix.browserSync({
        proxy: 'localhost:8080',
        open: false,
        files: [
            'resources/views/**/*.blade.php',
            'resources/js/**/*.vue',
            'public/js/**/*.js',
            'public/css/**/*.css'
        ],
    });
}
