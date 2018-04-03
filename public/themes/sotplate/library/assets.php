<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

function asset_path($path)
{
    return stylesheet_path('/assets/'.$path);
}

function asset_url($url)
{
    return get_stylesheet_directory_uri().'/assets/'.$url;
}

function image_path($path)
{
    return asset_path('images/'.$path);
}

function image_url($url)
{
    return asset_url('images/'.$url);
}

function require_image($imagePath)
{
    if (defined('WP_DEBUG') &&  WP_DEBUG) {
        echo '<!-- '.esc_html(image_path($imagePath)).' -->'.PHP_EOL;
    }

    require_svg($imagePath);
}

// expexts $imagePath relative to theme/assets/images/
function require_svg($imagePath)
{
    require_svg_absolute(image_path($imagePath));
}

// require svg with unique "cls-" class names
function require_svg_absolute($imagePath)
{
    $image = file_get_contents($imagePath);

    $hash = md5(image_path($imagePath));
    $image = str_replace('cls-', 'cls-' . $hash . '-', $image);

    echo $image;
}

function filemtime_base36($path)
{
    if (file_exists($path)) {
        $mtime = filemtime($path);
        if ($mtime !== false) {
            return base_convert($mtime, 10, 36);
        }
    }
    return false;
}

// Enqueue and register scripts the right way.
add_action('wp_enqueue_scripts', function () {
    wp_deregister_script('jquery');

    wp_enqueue_style(
        'wordplate',
        mix('styles/app.css'),
        false,
        filemtime_base36(stylesheet_path('assets/styles/app.css')),
        false
    );

    /*
    wp_enqueue_script(
        'modernizr',
        asset('assets/scripts/modernizr.js'),
        FALSE,
        filemtime_base36(stylesheet_path('assets/scripts/modernizr.js')),
        FALSE
    );
    */

    wp_enqueue_script(
        'wordplate',
        mix('scripts/app.js'),
        false,
        filemtime_base36(stylesheet_path('assets/scripts/app.js')),
        true
    );
});
