<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

add_action('admin_head', 'sotplate_admin_favicon');
add_action('login_head', 'sotplate_admin_favicon');
function sotplate_admin_favicon()
{
    echo '<link rel="icon" href="' . image_url('favicons/favicon.admin.png') . '" type="image/png" />' . "\n";
}
