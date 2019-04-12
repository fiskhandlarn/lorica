<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

// polyfills for wordplate/polylang

if (!function_exists('pll_translations')) {
    function pll_translations(array $groups, $multiline = false)
    {
        // do nothing
    }
}

if (!function_exists('trans')) {
    function trans(string $key, string $lang = null): string
    {
        return __($key);
    }
}
