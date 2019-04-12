<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

// Don't create the cache directory (this could instead be handled with a .gitignore file)
add_filter('blade/cache/create', '__return_false');
