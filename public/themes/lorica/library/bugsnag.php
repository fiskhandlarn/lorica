<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

if (!function_exists('bugsnag_error')) {
    function bugsnag_error($name, $message, array $metaData = null, $severity = null)
    {
        if (!env('DISABLE_BUGSNAG')) {
            if (class_exists('Bugsnag_Wordpress')) {
                global $bugsnagWordpress;

                if (isset($bugsnagWordpress)) {
                    $bugsnagWordpress->notifyError($name, $message, $metaData, $severity);
                }
            }
        }
    }
}

if (class_exists('Bugsnag_Wordpress')) {
    if (env('DISABLE_BUGSNAG')) {
        // https://github.com/bugsnag/bugsnag-wordpress/issues/27#issuecomment-458890694
        restore_error_handler();
        restore_exception_handler();
    } else {
        global $bugsnagWordpress;

        if (isset($bugsnagWordpress)) {
            // Bugsnag reports PHP warnings for code that is silenced with an @.
            // https://github.com/bugsnag/bugsnag-wordpress/issues/35#issuecomment-457130639
            $bugsnagWordpress->setBeforeNotifyFunction(function ($report) {
                if (error_reporting() === 0) {
                    return false;
                }
            });
        }
    }
}
