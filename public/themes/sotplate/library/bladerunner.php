<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

// Make bladerunner look in resources/ instead of in the theme folder (Laravel style)
add_filter('bladerunner/template/bladepath', function ($paths) {
    if (!is_array($paths)) {
        $paths = [$paths];
    }
    $paths[] = base_path('resources/views');
    return $paths;
});

// Make bladerunner save cached files in storage/ instead of in the theme folder (Laravel style)
add_filter('bladerunner/cache/path', function ($path) {
    return base_path('storage/views');
});

// Don't create the cache directory (this should instead be handled via storage/views/.gitignore)
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
