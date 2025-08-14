const mix = require('laravel-mix')
const webpack = require('webpack')

require('laravel-mix-clean')

mix.setPublicPath('./assets/dist')
mix.clean()

mix
    .options({
        processCssUrls: false,
        watchOptions: {
            ignored: /node_modules/,
        },
        terser: {
            terserOptions: {
                keep_fnames: true,
            },
        },
    })
    .webpackConfig({
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'window.jQuery': 'jquery',
            }),
        ],
    })
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery'],
    })

mix.copyDirectory('assets/src/fonts', 'assets/dist/fonts')
mix.copyDirectory('assets/src/images', 'assets/dist/images')

mix
    //.css('assets/src/css/app.css', 'assets/dist/css')
    .sass('assets/src/scss/app.scss', 'assets/dist/css')
    .options({ processCssUrls: false })
    .version()

mix
    .js('node_modules/jquery/dist/jquery.min.js', 'assets/dist/js/jquery.js')

mix
    .js('assets/src/js/app.js', 'assets/dist/js')
    .version()

if (!mix.inProduction()) {
    mix.sourceMaps()
}