const mix = require('laravel-mix');
const sassLintPlugin = require('sasslint-webpack-plugin');
const styleLintPlugin = require('stylelint-webpack-plugin');
require('dotenv').config();
const imageminPlugin = require('imagemin-webpack-plugin').default;
const copyWebpackPlugin = require('copy-webpack-plugin');
const modernizrWebpackPlugin = require('modernizr-webpack-plugin');
const modernizrSettings = require('./modernizr.json');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

const theme = process.env.WP_THEME;
const publicPath = `public/themes/${theme}/assets`;

mix.setResourceRoot('../');
mix.setPublicPath(publicPath);

mix.js('resources/assets/scripts/app.js', 'scripts');
mix.sass('resources/assets/styles/app.scss', 'styles');

// prepare for REVENGE (only included by theme if WP_DEBUG is true)
mix.copy('vendor/heydon/revenge.css/revenge.css', `${publicPath}/styles`);

mix.webpackConfig({
  module: {
    rules: [{
      test: /\.js?$/,
      use: [
        {
          loader: 'babel-loader',
          options: mix.config.babel(),
        },
        {
          loader: 'eslint-loader',
        },
      ],
    }],
  },
  module: {
    rules: [{
      test: /\.scss$/,
      loader: 'import-glob-loader',
    }],
  },
  plugins: [
    new sassLintPlugin({
      glob: 'resources/assets/styles/**/*.s?(a|c)ss',
    }),
    new styleLintPlugin({
      context: 'resources/assets/styles/',
    }),
    // Copy the fonts folder
    new copyWebpackPlugin([{
      from: 'resources/assets/fonts/',
      to: 'fonts'
    }]),
    // Copy the images folder and optimize all the images
    new copyWebpackPlugin([{
      from: 'resources/assets/images/',
      to: 'images'
    }]),
    new imageminPlugin({
      test: /\.svg$/i,
      svgo: {
        plugins: [
          {
            removeTitle: true,
            removeStyleElement: true
          }
        ]
      }
    }),
    new modernizrWebpackPlugin(
      Object.assign(
        {
          filename: 'scripts/modernizr.js'
        },
        modernizrSettings
      )
    )
  ]
});

// versioning
if (mix.config.inProduction) {
  mix.version();
}

// Browsersync
mix.browserSync({
  proxy: process.env.BROWSER_SYNC_HOST,
});
