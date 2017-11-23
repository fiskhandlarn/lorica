<?php

namespace NordeaMasters\Optimizers;

use Spatie\ImageOptimizer\Image;
use Spatie\ImageOptimizer\Optimizers\Svgo;

class CustomSvgo extends Svgo
{
    public $binaryName = 'npm run svgo --';

    public $options = [
        '--disable=cleanupIDs',
        '--enable=removeTitle',
        '--disable=removeStyleElement', // some colored logos rely on style-tag
        '--enable=removeScriptElement',
        '--enable=removeEmptyContainers',
    ];

    public function canHandle(Image $image): bool
    {
        if ($image->extension() !== 'svg' && $image->extension() !== 'tmp') {
            return false;
        }

        return $image->mime() === 'text/html';
    }
}
