
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
let production = mix.inProduction();

mix.setPublicPath('public/');

mix.js('resources/js/app.js', 'public/js').vue()
    .copy('resources/images', 'public/images')
    // .sass('resources/sass/app.scss', 'public/css').options({
    //     processCssUrls: false
    // })
    .options({
        hmrOptions: {
            host: 'localhost',
            port: '3001'
        },
    })
    .webpackConfig(require('./webpack.config'))
    //.sourceMaps(!production, 'source-map')
    .disableNotifications()
    .browserSync({
        proxy: process.env.APP_URL,
        notify: false,
        open: false
    });


if (production) {
    mix.version(['public/images']);
    //mix.version(['public/images', 'public/Admin/**/*.{js,css,png,jpg,gif,svg}']);
}

