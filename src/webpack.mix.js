'use strict';
const mix = require('laravel-mix');
const path = require('path');

const HtmlWebpackPlugin = require('html-webpack-plugin');
const HtmlWebpackExcludeAssetsPlugin = require('html-webpack-exclude-assets-plugin');
const webpack = require('webpack');

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
mix.webpackConfig({
  output:{
    publicPath: '',
  },
  module: {
    rules: [
      {
        enforce: 'pre',
        test: /\.vue$/,
        exclude: /node_modules/,
        loader: 'eslint-loader'
      }
    ],
  },
  resolve: {
    alias: {
      Assets: path.resolve(__dirname, 'resources/js/vue/assets'),
      Base: path.resolve(__dirname, 'resources/js/vue/'),
      Components: path.resolve(__dirname, 'resources/js/vue/components'),
      Constants: path.resolve(__dirname, 'resources/js/vue/constants'),
      Views: path.resolve(__dirname, 'resources/js/vue/views')
    }
  },
  plugins: [
    new HtmlWebpackPlugin({
      hash: true,
      template: 'public/index.template.html'
    }),
    new HtmlWebpackExcludeAssetsPlugin(),
    new webpack.ContextReplacementPlugin(
      /moment[/\\]locale$/,
      /en/
    ),
  ]
});

mix
  .js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .options({
    processCssUrls: false
  });

if (process.env.NODE_ENV !== 'testing') {
  mix.version();
}