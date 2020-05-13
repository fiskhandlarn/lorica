<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

function asset_path(string $path = ''): string
{
    $path = ltrim($path, '/');
    return get_theme_file_path('assets/'.$path);
}

function asset_url(string $url = ''): string
{
    $url = ltrim($url, '/');
    return get_theme_file_uri('assets/'.$url);
}

function image_path(string $path = ''): string
{
    $path = ltrim($path, '/');
    return asset_path('images/'.$path);
}

function image_url(string $url = ''): string
{
    $url = ltrim($url, '/');
    return asset_url('images/'.$url);
}

function require_image($imagePath)
{
    if (defined('WP_DEBUG_DISPLAY') && WP_DEBUG_DISPLAY) {
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
    if (get_theme_support('lorica-deregister-jquery')) {
        wp_deregister_script('jquery');
    }

    if (get_theme_support('lorica-enqueue-app-css')) {
        wp_enqueue_style(
            'lorica',
            asset_url('styles/app.css'),
            false,
            filemtime_base36(asset_path('styles/app.css')),
            false
        );
    }

    if (get_theme_support('lorica-enqueue-modernizr')) {
        wp_enqueue_script(
            'modernizr',
            asset_url('scripts/modernizr.js'),
            false,
            filemtime_base36(asset_path('scripts/modernizr.js')),
            false
        );
    }

    if (get_theme_support('lorica-enqueue-app-js')) {
        wp_enqueue_script(
            'lorica',
            asset_url('scripts/app.js'),
            false,
            filemtime_base36(asset_path('scripts/app.js')),
            true
        );
    }
});

if (get_theme_support('lorica-enqueue-modernizr')) {
    // https://wordpress.stackexchange.com/a/19309/144404
    add_filter(class_exists('Roots\Soil\Options') ? 'soil/language_attributes' : 'language_attributes', function ($output) {
        if (strpos($output, ' class="no-js"') === false) {
            return $output . ' class="no-js"';
        }

        return $output;
    });
}
