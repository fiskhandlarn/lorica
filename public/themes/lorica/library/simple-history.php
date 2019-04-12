<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

// place simple-history under tools instead
add_filter('simple_history/admin_location', function() {
    return 'tools';
});
