<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Plate
|--------------------------------------------------------------------------
|
| Plate provides a bunch of handy WordPress defaults to help you get the
| most out of WordPress development.
|
| Please see https://github.com/wordplate/plate
|
*/

// Remove menu items.
add_theme_support('plate-disable-menu', [
    'edit-comments.php', // comments

    // temporarily enabling Dashboard so that Simple History can be found :(
    //    'index.php', // dashboard

    //'themes.php', // appearance
]);

// Remove meta boxes in post editor.
add_theme_support('plate-disable-editor', [
    'commentsdiv',
    'commentstatusdiv',
    'linkadvanceddiv',
    'linktargetdiv',
    'linkxfndiv',
    'postcustom',
    'postexcerpt',
    'revisionsdiv',
    'slugdiv',
    'sqpt-meta-tags',
    'trackbacksdiv',
    //'categorydiv',
    //'tagsdiv-post_tag',
]);

// Remove dashboard widgets.
add_theme_support('plate-disable-dashboard', [
    'dashboard_activity',
    'dashboard_incoming_links',
    'dashboard_plugins',
    'dashboard_recent_comments',
    'dashboard_primary',
    'dashboard_quick_press',
    'dashboard_recent_drafts',
    'dashboard_secondary',
    //'dashboard_right_now',
]);

// Remove links from admin toolbar.
add_theme_support('plate-disable-toolbar', [
    'comments',
    'wp-logo',
    'edit',
    'appearance',
    'view',
    'new-content',
    'updates',
    'search',
]);

// Remove dashboard tabs.
add_theme_support('plate-disable-tabs', ['help', 'screen-options']);

// Set custom permalink structure.
add_theme_support('plate-permalink', '/%postname%/');

// Set custom login logo.
add_theme_support('plate-login-logo', asset('assets/images/favicons/android-chrome-192x192.png'));

// Set custom footer text.
//add_theme_support('plate-footer', 'Thank you for creating with <a href="https://wordplate.github.io" target="_blank">WordPlate</a>.');
