<?php

declare(strict_types=1);

if (!defined('ABSPATH')) { exit(); }

if ( class_exists('ITSEC_WordPress_Tweaks') ) {
    add_action('init', function () {
        // better-wp-security tries to look for jquery in registered scripts
        // (which we've already removed in wp_enqueue_scripts),
        // disable that:
        remove_action( 'wp_print_scripts', array( ITSEC_WordPress_Tweaks::get_instance(), 'store_jquery_version' ) );
    });
}
