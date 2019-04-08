<?php

declare(strict_types=1);

require_if_theme_supports('sotplate-bugsnag', template_path('library/bugsnag.php'));

// Register plugin helpers.
require_once template_path('library/assets.php');
require_once template_path('library/better-wp-security.php');
require_once template_path('library/classic-editor.php');
require_once template_path('library/normalizer.php');

require_if_theme_supports('sotplate-admin-favicon', template_path('library/admin-favicon.php'));
require_if_theme_supports('sotplate-blade', template_path('library/blade.php'));
require_if_theme_supports('sotplate-cookie-bar', template_path('library/cookie-bar.php'));
require_if_theme_supports('sotplate-helpers', template_path('library/helpers.php'));
require_if_theme_supports('sotplate-no-js', template_path('library/no-js.php'));
require_if_theme_supports('sotplate-no-touch', template_path('library/no-touch.php'));
require_if_theme_supports('sotplate-pixel', template_path('library/pixel.php'));
require_if_theme_supports('sotplate-polylang', template_path('library/polylang.php'));
require_if_theme_supports('sotplate-soil', template_path('library/soil.php'));
require_if_theme_supports('sotplate-svg', template_path('library/svg.php'));
