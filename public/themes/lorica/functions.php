<?php

declare(strict_types=1);

require_if_theme_supports('lorica-bugsnag', template_path('library/bugsnag.php'));

// Register plugin helpers.
require_once template_path('library/assets.php');
require_once template_path('library/better-wp-security.php');
require_once template_path('library/normalizer.php');

require_if_theme_supports('lorica-admin-favicon', template_path('library/admin-favicon.php'));
require_if_theme_supports('lorica-blade', template_path('library/blade.php'));
require_if_theme_supports('lorica-cookie-bar', template_path('library/cookie-bar.php'));
require_if_theme_supports('lorica-helpers', template_path('library/helpers.php'));
require_if_theme_supports('lorica-no-js', template_path('library/no-js.php'));
require_if_theme_supports('lorica-no-touch', template_path('library/no-touch.php'));
require_if_theme_supports('lorica-pixel', template_path('library/pixel.php'));
require_if_theme_supports('lorica-polylang', template_path('library/polylang.php'));
require_if_theme_supports('lorica-simple-history', template_path('library/simple-history.php'));
require_if_theme_supports('lorica-seo', template_path('library/seo.php'));
require_if_theme_supports('lorica-soil', template_path('library/soil.php'));
require_if_theme_supports('lorica-svg', template_path('library/svg.php'));
require_if_theme_supports('lorica-whoops', template_path('library/whoops.php'));
