const mix = require('laravel-mix');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const ModernizrWebpackPlugin = require('modernizr-webpack-plugin');
const modernizrSettings = require('./modernizr.json');
const CopyWebpackPlugin = require('copy-webpack-plugin');

require('dotenv').config();

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

mix.webpackConfig({
  module: {
    rules: [
      {
        test: /\.js?$/,
        exclude: /node_modules/,
        use: [
          {
            loader: 'eslint-loader',
          },
        ],
      },
      {
        test: /\.scss$/,
        loader: 'import-glob-loader',
      },
      // {
      //   test: /\.handlebars?$/,
      //   loader: 'handlebars-loader',
      // },
    ],
  },
  plugins: [
    new StyleLintPlugin({
      context: '// resources/assets/styles doesnt work o_O',
      context: 'resources',
    }),
    // Copy the fonts folder
    new CopyWebpackPlugin([{
      from: 'resources/assets/fonts/',
      to: 'fonts'
    }]),
    // Copy the images folder and optimize all the images
    new CopyWebpackPlugin([{
      from: 'resources/assets/images/',
      to: 'images'
    }]),
    new ImageminPlugin({
      test: /\.svg$/i,
      svgo: {
        plugins: [
          {
            removeTitle: true
          },
          {
            removeStyleElement: true
          },
          {
            removeAttrs : {
              attrs : [ "class", "style" ]
            }
          }
        ]
      }
    }),
    new ModernizrWebpackPlugin(
      Object.assign(
        {
          filename: 'scripts/modernizr.js'
        },
        modernizrSettings
      )
    ),
  ],
});

// Compile javascript.
mix.js('resources/assets/scripts/app.js', 'scripts');

// Compile styles.
mix.sass('resources/assets/styles/app.scss', 'styles', {
  includePaths: ['node_modules'],
});

// Prepare for REVENGE (only included by theme if WP_DEBUG is true)
mix.copy('vendor/heydon/revenge.css/revenge.css', `${publicPath}/styles`);

// Versioning.
mix.version();

if (process.env.BROWSER_SYNC_HOST) {
  // Browsersync.
  mix.browserSync({
    proxy: process.env.BROWSER_SYNC_HOST,
    files: [
      'resources/views/**/*.php',
      `${publicPath}/**/*.js`,
      `${publicPath}/**/*.css`,
    ],
  });
}
