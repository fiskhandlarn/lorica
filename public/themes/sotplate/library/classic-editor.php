<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

add_action('wp_enqueue_scripts', function () {
    // bail if classic editor setting is set to block or no-replace
    $option = get_option('classic-editor-replace');
    if ($option === 'block' || $option === 'no-replace') {
        return;
    }

    // bail if classic editor plugin is not active. can't use is_plugin_active() here, unless you include wp-admin/includes/plugin.php
    // https://stackoverflow.com/a/6932467/1109380
    if (count(array_filter(apply_filters('active_plugins', get_option('active_plugins')), function ($el) {
        return (strpos($el, 'classic-editor/classic-editor.php') !== false);
    })) < 1) {
        return;
    }

    // dequeue the block library, so that you don't have /wp-includes/css/dist/block-library/style.min.css in each and every page of your site
    wp_dequeue_style('wp-block-library');
}, 100);
