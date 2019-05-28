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
    function debuglog($message, $forceVarExport = false)
    {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            if ($forceVarExport || is_array($message) || is_object($message)) {
                error_log(var_export($message, true) . "\n");
            } else {
                error_log($message . "\n");
            }
        }
    }
}

if (!function_exists('force_404')) {
    // https://wordpress.stackexchange.com/a/92176
    function force_404()
    {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
        get_template_part("404");
        die();
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

if (!function_exists('usortstable')) {
    // http://www.php.net/manual/en/function.usort.php#38827
    function usortstable(&$array, $cmp_function = 'strcmp')
    {
        // Arrays of size < 2 require no action.
        if (count($array) < 2) {
            return;
        }
        // Split the array in half
        $halfway = intval(count($array) / 2);
        $array1 = array_slice($array, 0, $halfway);
        $array2 = array_slice($array, $halfway);
        // Recurse to sort the two halves
        usortstable($array1, $cmp_function);
        usortstable($array2, $cmp_function);
        // If all of $array1 is <= all of $array2, just append them.
        if (call_user_func($cmp_function, end($array1), $array2[0]) < 1) {
            $array = array_merge($array1, $array2);
            return;
        }
        // Merge the two sorted arrays into a single sorted array
        $array = array();
        $ptr1 = $ptr2 = 0;
        while ($ptr1 < count($array1) && $ptr2 < count($array2)) {
            if (call_user_func($cmp_function, $array1[$ptr1], $array2[$ptr2]) < 1) {
                $array[] = $array1[$ptr1++];
            } else {
                $array[] = $array2[$ptr2++];
            }
        }
        // Merge the remainder
        while ($ptr1 < count($array1)) {
            $array[] = $array1[$ptr1++];
        }
        while ($ptr2 < count($array2)) {
            $array[] = $array2[$ptr2++];
        }
        return;
    }
}

if (!function_exists('wpautop_class')) {
    // https://codex.wordpress.org/Function_Reference/wpautop but with added class
    function wpautop_class(string $pee, string $class, bool $br = true):string
    {
        // https://stackoverflow.com/a/45937558/1109380
        return str_replace('<p>', '<p class="' . $class . '">', wpautop($pee, $br));
    }
}
