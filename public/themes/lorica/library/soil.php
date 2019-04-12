<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

// configure roots/soil
// https://github.com/roots/soil

// Cleanup WordPress default theme markup.
add_theme_support('soil-clean-up');

// Disable asset versioning.
add_theme_support('soil-disable-asset-versioning');

// Disable trackbacks.
add_theme_support('soil-disable-trackbacks');

// Move all JavaScript to the footer
add_theme_support('soil-js-to-footer');

// Update search results from /?s=query to /search/query.
add_theme_support('soil-nice-search');

// Update absolute URLs with root relative URLs.
//add_theme_support('soil-relative-urls');

//add_theme_support('soil-nav-walker');

function google_analytics_deploy($trackingID)
{
    $correct_action = "after_setup_theme";

    if ($correct_action !== current_filter()) {
        _doing_it_wrong(__FUNCTION__, __("This should be called from the '$correct_action' action"), "0.2");
    }

    if (!defined('WP_DEBUG_DISPLAY') || !WP_DEBUG_DISPLAY) {
        add_theme_support('soil-google-analytics', $trackingID, 'wp_head');
    }
}
