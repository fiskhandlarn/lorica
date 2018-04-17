<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

// Add custom template views directory path to Bladerunner.
add_filter('bladerunner/template/bladepath', function ($paths) {
    $paths = array_wrap($paths);

    $paths[] = base_path('resources/views');

    return $paths;
});

// Add custom cache directory path to Bladerunner.
add_filter('bladerunner/cache/path', function () {
    return base_path('storage/views');
});

// Don't create the cache directory (this could instead be handled with a .gitignore file)
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
