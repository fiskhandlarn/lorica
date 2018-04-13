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

    return $file;
});
