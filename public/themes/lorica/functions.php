<?php

declare(strict_types=1);

require_if_theme_supports('lorica-bugsnag', get_theme_file_path('library/bugsnag.php'));

// Register plugin helpers.
require_once get_theme_file_path('library/assets.php');
require_once get_theme_file_path('library/better-wp-security.php');
require_once get_theme_file_path('library/normalizer.php');

require_if_theme_supports('lorica-admin-favicon', get_theme_file_path('library/admin-favicon.php'));
require_if_theme_supports('lorica-blade', get_theme_file_path('library/blade.php'));
require_if_theme_supports('lorica-cookie-bar', get_theme_file_path('library/cookie-bar.php'));
require_if_theme_supports('lorica-helpers', get_theme_file_path('library/helpers.php'));
require_if_theme_supports('lorica-no-js', get_theme_file_path('library/no-js.php'));
require_if_theme_supports('lorica-no-touch', get_theme_file_path('library/no-touch.php'));
require_if_theme_supports('lorica-pixel', get_theme_file_path('library/pixel.php'));
require_if_theme_supports('lorica-polylang', get_theme_file_path('library/polylang.php'));
require_if_theme_supports('lorica-simple-history', get_theme_file_path('library/simple-history.php'));
require_if_theme_supports('lorica-seo', get_theme_file_path('library/seo.php'));
require_if_theme_supports('lorica-soil', get_theme_file_path('library/soil.php'));
require_if_theme_supports('lorica-svg', get_theme_file_path('library/svg.php'));
require_if_theme_supports('lorica-whoops', get_theme_file_path('library/whoops.php'));
