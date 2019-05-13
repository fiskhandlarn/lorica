<?php

declare(strict_types=1);

//require_once template_path('library/disable-rest-api.php');

require_once stylesheet_path('/includes/plate.php');
if (function_exists('pll__')) {
    require_once stylesheet_path('/includes/translations.php');
}
require_once stylesheet_path('/includes/image-sizes.php');

// request support for lorica features
add_theme_support('lorica-deregister-jquery');
add_theme_support('lorica-enqueue-app-css');
//add_theme_support('lorica-enqueue-modernizr');
add_theme_support('lorica-enqueue-app-js');
add_theme_support('lorica-admin-favicon');
add_theme_support('lorica-blade');
add_theme_support('lorica-bugsnag');
add_theme_support('lorica-cookie-bar');
add_theme_support('lorica-helpers');
//add_theme_support('lorica-no-js');
add_theme_support('lorica-no-touch'); // a prerequisite for /resources/assets/styles/mixins/_no-touch.scss mixins
//add_theme_support('lorica-pixel');
add_theme_support('lorica-polylang');
add_theme_support('lorica-simple-history');
add_theme_support('lorica-seo');
add_theme_support('lorica-soil');
add_theme_support('lorica-svg');
add_theme_support('lorica-whoops');

// do this after lorica has been loaded
add_action('after_setup_theme', function () {
    //pixel_deploy(env("PIXEL_ID"));
    //google_analytics_deploy(env("GOOGLE_ANALYTICS_ID"));
});

// Set theme defaults.
add_action('after_setup_theme', function () {
    // Show the admin bar.
    show_admin_bar(false);

    // Add post thumbnails support.
    add_theme_support('post-thumbnails');

    // Add support for post formats.
    //add_theme_support('post-formats', ['aside', 'audio', 'gallery', 'image', 'link', 'quote', 'video']);

    // Add title tag theme support.
    add_theme_support('title-tag');

    // Add HTML5 support.
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'widgets',
    ]);

    // Add primary WordPress menu.
    register_nav_menu('primary-menu', __('Primary Menu', 'wordplate'));
});

// // Remove JPEG compression.
// add_filter('jpeg_quality', function () {
//     return 100;
// }, 10, 2);

// // Set custom excerpt more.
// add_filter('excerpt_more', function () {
//     return '...';
// });

// // Set custom excerpt length.
// add_filter('excerpt_length', function () {
//     return 101;
// });
