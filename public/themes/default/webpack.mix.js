let mix = require('laravel-mix');

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

mix.less('assets/less/style.less', 'assets/css')
	.options({ processCssUrls: false })
	.scripts(['assets/js/jquery.min.js', 'assets/js/bootstrap.min.js', 'assets/js/imagesloaded.pkgd.min.js', 'assets/js/jquery.fitvid.js', 'assets/js/jquery.tagsinput.js', 'assets/js/jquery.timeago.js', 'assets/js/masonry.pkgd.min.js', 'assets/js/nprogress.js', 'assets/js/jquery.infinitescroll.min.js', 'assets/js/script_upload.js'], 'assets/app.js')
    .styles(['assets/css/*'], 'assets/app.css');