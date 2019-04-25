const mix = require('laravel-mix');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const ModernizrWebpackPlugin = require('modernizr-webpack-plugin');
const modernizrSettings = require('./modernizr.json');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const WebappWebpackPlugin = require('webapp-webpack-plugin');

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
    new WebappWebpackPlugin({
      logo: './resources/assets/images/favicon.svg',
      outputPath: 'images/favicons',
      inject: true,
      favicons: {
        background: '#000000',
        icons: {
          android: true,
          appleIcon: true,
          appleStartup: false,
          coast: true,
          favicons: true,
          firefox: true,
          windows: true,
          yandex: true,
        },
      },
    }),
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

if (process.env.WP_DEBUG_DISPLAY == "true") {
  mix.styles([`${publicPath}/styles/app.css`, 'node_modules/revenge.css/revenge.css'], `${publicPath}/styles/app.css`);
}

// Versioning.
mix.version();

if (process.env.BROWSER_SYNC_HOST && process.env.BROWSER_SYNC_DISABLE != "true") {
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
