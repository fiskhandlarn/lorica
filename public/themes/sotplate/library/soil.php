<?php

declare(strict_types=1);

if (!defined('ABSPATH')) { exit(); }

// configure roots/soil
// https://github.com/roots/soil
add_action('after_setup_theme', function () {
    add_theme_support('soil-clean-up');
    add_theme_support('soil-disable-trackbacks');
    //add_theme_support('soil-google-analytics', 'UA-XXXXX-Y', 'wp_head');
    add_theme_support('soil-js-to-footer');
    //add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
});

function google_analytics_deploy($trackingID)
{
    $correct_action = "after_setup_theme";

    if ($correct_action !== current_filter()) {
        _doing_it_wrong( __FUNCTION__, __("This should be called from the '$correct_action' action"), "0.2");
    }

    if (!defined('WP_DEBUG') || !WP_DEBUG) {
        add_theme_support('soil-google-analytics', $trackingID, 'wp_head');
    }
}
