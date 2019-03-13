<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

add_action('admin_head', function () {
    echo '<link rel="icon" href="' . image_url('favicons/favicon.admin.png') . '" type="image/png" />' . "\n";
});
