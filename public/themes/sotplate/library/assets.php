<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

function asset_path($path)
{
    return stylesheet_path('assets/'.$path);
}

function asset_url($url)
{
    return asset('assets/'.$url);
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
    if (defined('WP_DEBUG') && WP_DEBUG) {
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
    if (get_theme_support('sotplate-deregister-jquery')) {
        wp_deregister_script('jquery');
    }

    if (get_theme_support('sotplate-enqueue-app-css')) {
        wp_enqueue_style(
            'wordplate',
            mix('styles/app.css'),
            false,
            filemtime_base36(asset_path('styles/app.css')),
            false
        );
    }

    // Add https://github.com/Heydon/REVENGE.CSS when developing
    if (defined('WP_DEBUG') && WP_DEBUG) {
        wp_enqueue_style(
            'revenge.css',
            mix('styles/revenge.css'),
            false,
            filemtime_base36(asset_path('styles/revenge.css')),
            false
        );
    }

    if (get_theme_support('sotplate-enqueue-modernizr')) {
        wp_enqueue_script(
            'modernizr',
            asset('assets/scripts/modernizr.js'),
            FALSE,
            filemtime_base36(asset_path('scripts/modernizr.js')),
            FALSE
        );
    }

    if (get_theme_support('sotplate-enqueue-app-js')) {
        wp_enqueue_script(
            'wordplate',
            mix('scripts/app.js'),
            false,
            filemtime_base36(asset_path('scripts/app.js')),
            true
        );
    }
});
