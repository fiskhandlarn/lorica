<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

add_filter('bladerunner/template/bladepath', function ($paths) {
    if (!is_array($paths)) {
        $paths = [$paths];
    }
    $paths[] = base_path('resources/views');
    return $paths;
});

add_filter('bladerunner/cache/path', function ($path) {
    return base_path('storage/views');
});

add_filter('bladerunner/cache/make', function () {
    return false;
});

// add_filter('bladerunner/controller/paths', function ($paths) {
//     if (!is_array($paths)) {
//         $paths = [$paths];
//     }
//     $paths[] = ABSPATH . '../../resources/controllers';
//     return $paths;
// });
