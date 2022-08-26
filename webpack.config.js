const path = require('path');
const webpack = require('webpack');
const OpenBrowserPlugin = require('webpack-open-browser-plugin');
let project_name = require("path").basename(__dirname);


module.exports = {

    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
            '~': path.resolve('node_modules'),
            'public': path.resolve('public'),
            'resources/lang': path.resolve('resources/lang'),
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
