const mix = require('laravel-mix');
const sassLintPlugin = require('sasslint-webpack-plugin');
const styleLintPlugin = require('stylelint-webpack-plugin');

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

const theme = 'wordplate';

mix.setResourceRoot('../');
mix.setPublicPath(path.normalize(`public/themes/${theme}/assets`));

mix.js('resources/assets/scripts/app.js', 'scripts');
mix.sass('resources/assets/styles/app.scss', 'styles');

mix.webpackConfig({
  module: {
    rules: [{
      test: /\.js?$/,
      use: [
        {
          loader: 'babel-loader',
          options: mix.config.babel()
        },
        {
          loader: 'eslint-loader',
        }
      ]
    }]
  },
  module: {
    rules: [{
      test: /\.scss$/,
      loader: 'import-glob-loader'
    }]
  },
  plugins: [
    new sassLintPlugin({
      glob: 'resources/assets/styles/**/*.s?(a|c)ss'
    }),
    new styleLintPlugin({
      context: 'resources/assets/styles/'
    })
  ]
});

mix.version();
