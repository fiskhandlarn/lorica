<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

if (!function_exists('array_move_element')) {
    function array_move_element(&$array, $a, $b)
    {
        $out = array_splice($array, $a, 1);
        array_splice($array, $b, 0, $out);
    }
}

if (!function_exists('debuglog')) {
    function debuglog($message, $forcePrintR = false)
    {
        if (WP_DEBUG === true) {
            if ($forcePrintR || is_array($message) || is_object($message)) {
                error_log(print_r($message, true) . "\n");
            } else {
                error_log($message . "\n");
            }
        }
    }
}

if (!function_exists('get_current_slug')) {
    function get_current_slug()
    {
        if (!in_the_loop()) {
            _doing_it_wrong(__FUNCTION__, __("This should be called from within The Loop"), "0.2");
            return null;
        }

        $postID = get_the_ID();
        $post = get_post($postID);

        if ($post) {
            return $post->post_name;
        }

        return null;
    }
}

if (!function_exists('get_current_url')) {
    function get_current_url()
    {
        $pageURL = 'http';
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
}

if (! function_exists('get_posted_value')) {
    function get_posted_value($value, $default=false)
    {
        if (isset($_REQUEST[$value])) {
            return stripslashes($_REQUEST[$value]);
        }

        return $default;
    }
}

if (!function_exists('insert_array_at_position')) {
    // https://stackoverflow.com/a/3354804
    function insert_array_at_position($array, $insert, $position)
    {
        return array_slice($array, 0, $position, true) +
            $insert +
            array_slice($array, $position, null, true);
    }
}

if (! function_exists('is_ajax')) {
    /**
     * is_ajax - Returns true when the page is loaded via ajax.
     * @return bool
     */
    function is_ajax()
    {
        return defined('DOING_AJAX');
    }
}

if (!function_exists('mb_ucfirst')) {
    // https://php.net/manual/en/function.ucfirst.php#57298
    function mb_ucfirst($str)
    {
        $fc = mb_strtoupper(mb_substr($str, 0, 1));
        return $fc.mb_substr($str, 1);
    }
}

if (! function_exists('set_eternal_cookie')) {
    function set_eternal_cookie($name, $value)
    {
        $is_ajax = (defined('DOING_AJAX') ? DOING_AJAX : false);
        if (!is_admin() || $is_ajax) {
            $time = time()+(60*60*24*365); // 1 year
            setcookie($name, $value, $time, COOKIEPATH, COOKIE_DOMAIN);
            if (SITECOOKIEPATH != COOKIEPATH) {
                setcookie($name, $value, $time, SITECOOKIEPATH, COOKIE_DOMAIN);
            }
        }
    }
}

if (!function_exists('shorten_text')) {
    function shorten_text($text, $maxNrChars, $addEllipsis = true)
    {
        $text = trim($text);

        if (mb_strlen($text) > $maxNrChars) {
            $text = mb_substr($text, 0, $maxNrChars) . ($addEllipsis ? "&hellip;" : "");
        }

        return $text;
    }
}
