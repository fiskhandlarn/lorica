<?php

declare(strict_types=1);

if (!defined('ABSPATH')) { exit(); }

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

// add support for localized strftime()
if (function_exists('pll_current_language')) {
    add_action( 'init', function() {
        $polylangLocale = pll_current_language('locale');

        // https://stackoverflow.com/a/5879078/1109380
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {

            // TODO automate this
            // http://se2.php.net/manual/en/function.setlocale.php#refsect1-function.setlocale-notes ->
            // https://msdn.microsoft.com/en-us/library/39cwe7zf%28v=vs.90%29.aspx
            switch ($polylangLocale) {
            case "sv_SE":
                $polylangLocale = "swedish";
                break;
            default:
                $polylangLocale = "english";
            }
        } else {
            $polylangLocale .= ".utf8";
        }

        setlocale(LC_ALL, $polylangLocale);
    });
}
