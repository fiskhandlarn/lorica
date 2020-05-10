<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

// start with assuming no support for js
// https://wordpress.stackexchange.com/a/19309/144404
add_filter(class_exists('Roots\Soil\Options') ? 'soil/language_attributes' : 'language_attributes', function ($output) {
    if (strpos($output, ' class="no-js"') === false) {
        return $output . ' class="no-js"';
    }

    return $output;
});

// Remove <html class="no-js"> & set <html class="js"> if browser support javascript.
add_action('wp_head', function () {
    ?>
    <script type="text/javascript">(function (d){d.className=d.className.replace(/\bno-js\b/, 'js')})(document.documentElement)</script>
<?php
});
