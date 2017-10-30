const mix = require('laravel-mix');
const sassLintPlugin = require('sasslint-webpack-plugin');
const styleLintPlugin = require('stylelint-webpack-plugin');
require('dotenv').config();
const imageminPlugin = require('imagemin-webpack-plugin').default;
const copyWebpackPlugin = require('copy-webpack-plugin');

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

mix.setResourceRoot('../');
const assetsRoot = path.normalize(`public/themes/${theme}/assets`);
mix.setPublicPath(assetsRoot);

mix.js('resources/assets/scripts/app.js', 'scripts');
mix.sass('resources/assets/styles/app.scss', 'styles');

//https://laravel.com/docs/5.5/mix#copying-files-and-directories
mix.copyDirectory('resources/assets/fonts', `${assetsRoot}/fonts`);

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
      context: 'resources/assets/styles/'
    }),
    // Copy the images folder and optimize all the images
    new copyWebpackPlugin([{
      from: 'resources/assets/images/',
      to: 'images'
    }]),
    new imageminPlugin({
      test: /\.svg$/i,
      svgo: {
        plugins: [
          {removeTitle: true}
        ]
      }
    })
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
