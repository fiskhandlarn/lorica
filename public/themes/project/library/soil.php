<?php

declare(strict_types=1);

if (!defined('ABSPATH')) { exit(); }

// configure roots/soil
// https://github.com/roots/soil
add_action('after_setup_theme', function () {
    add_theme_support('soil-clean-up');
    add_theme_support('soil-disable-trackbacks');
    //add_theme_support('soil-google-analytics', 'UA-XXXXX-Y');
    add_theme_support('soil-js-to-footer');
    //add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
});
