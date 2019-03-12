<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

// https://css-tricks.com/snippets/wordpress/allow-svg-through-wordpress-media-uploader/
add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

// optimize uploaded svg files with svgo
use Spatie\ImageOptimizer\OptimizerChain;
use SotPlate\Optimizers\CustomSvgo;

add_filter('wp_handle_upload_prefilter', function ($file) {
    if ($file['type'] !== 'image/svg+xml') {
        return $file;
    }

    // run svgo on uploaded file
    $svgo = new CustomSvgo();
    $optimizerChain =
                    (new OptimizerChain)
                    ->addOptimizer($svgo)
                    ->optimize($file["tmp_name"]);


    // "WordPress now requires us to have the <xml> tag in our SVG files before uploading."
    // https://wordpress.org/plugins/svg-support/
    file_put_contents($file["tmp_name"], '<?xml version="1.0" encoding="utf-8"?>' . file_get_contents($file["tmp_name"]));

    return $file;
});
