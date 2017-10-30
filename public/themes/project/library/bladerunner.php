<?php

declare(strict_types=1);

if (!defined('ABSPATH')) { exit(); }

add_filter('bladerunner/template/bladepath', function ($paths) {
    if (!is_array($paths)) {
        $paths = [$paths];
    }
    $paths[] = ABSPATH . '../../resources/views';
    return $paths;
});
