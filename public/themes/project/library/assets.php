<?php

declare(strict_types=1);

if (!defined('ABSPATH')) { exit(); }

function image_path($path)
{
    return get_stylesheet_directory().'/assets/images/'.$path;
}

function image_url($url)
{
    return get_stylesheet_directory_uri().'/assets/images/'.$url;
}

function require_image($imagePath)
{
    if (defined('WP_DEBUG') &&  WP_DEBUG) {
        echo '<!-- '.esc_html(image_path($imagePath)).' -->'.PHP_EOL;
    }

    require_svg(image_path($imagePath));
}

// require svg with unique "cls-" class names
function require_svg($imagePath)
{

    $image = file_get_contents($imagePath);

    $hash = md5($imagePath);
    $image = str_replace('cls-', 'cls-' . $hash . '-', $image);

    echo $image;
}

function filemtime_base36($path)
{
    if (file_exists($path)) {
        $mtime = filemtime($path);
        if ($mtime !== FALSE) {
           return base_convert($mtime, 10, 36);
        }
    }
    return FALSE;
}

// Enqueue and register scripts the right way.
add_action('wp_enqueue_scripts', function () {
    wp_deregister_script('jquery');

    wp_enqueue_style(
        'wordplate',
        mix('styles/app.css'),
        FALSE,
        filemtime_base36(get_stylesheet_directory() . '/assets/styles/app.css'),
        FALSE
    );

    /*
    wp_enqueue_script(
        'modernizr',
        get_stylesheet_directory_uri().'/assets/scripts/modernizr.js',
        FALSE,
        filemtime_base36(get_stylesheet_directory().'/assets/scripts/modernizr.js'),
        FALSE
    );
    */

    wp_enqueue_script(
        'wordplate',
        mix('scripts/app.js'),
        FALSE,
        filemtime_base36(get_stylesheet_directory() . '/assets/scripts/app.js'),
        TRUE
    );
});
