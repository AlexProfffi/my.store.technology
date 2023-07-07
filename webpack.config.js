const path = require('path');
const webpack = require('webpack');
const OpenBrowserPlugin = require('webpack-open-browser-plugin');
let project_name = require("path").basename(__dirname);


module.exports = {

    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
            '~': path.resolve('node_modules'),
            'resources': path.resolve('resources'),
            'public': path.resolve('public'),
            'resources/lang': path.resolve('resources/lang'),
            'ziggy': path.resolve('vendor/tightenco/ziggy/dist/vue'),
        },
    },

    plugins: [
        new webpack.DefinePlugin({
            __VUE_OPTIONS_API__: true,
            __VUE_PROD_DEVTOOLS__: false,
        }),
        new OpenBrowserPlugin({
            url: process.env.APP_URL
        })
    ]

};
