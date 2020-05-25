<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

if (!function_exists('bugsnag_error')) {
    function bugsnag_error($name, $message, array $metaData = null, $severity = null)
    {
        if (env('BUGSNAG_SET_EXCEPTION_HANDLERS', true)) {
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
    if (env('BUGSNAG_SET_EXCEPTION_HANDLERS', true)) {
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
