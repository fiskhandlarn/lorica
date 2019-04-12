<?php

// Se more at https://github.com/wordplate/plugins/blob/master/plugins/seo.php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

// Update the post metabox priority to low.
add_filter('the_seo_framework_metabox_priority', function () {
    return 'low';
});

// Update the term metabox priority to low.
add_filter('the_seo_framework_term_metabox_priority', function () {
    return 11;
}, 10, 1);

// Disable plugin usage indicator in HTML output.
add_filter('the_seo_framework_indicator', '__return_false');

// Disable LD+Json search output.
add_filter('the_seo_framework_json_search_output', '__return_false');

// Disable "traffic lights" in post list.
//add_filter('the_seo_framework_show_seo_column', '__return_false');

// Give access to editors
add_filter('the_seo_framework_settings_capability', function () {
    return 'publish_pages';
});
