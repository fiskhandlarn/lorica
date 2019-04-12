<?php

namespace Lorica\Optimizers;

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

    public function __construct($options = [])
    {
        $this->setOptions($this->options);
    }

    public function canHandle(Image $image): bool
    {
        if (
            $image->extension() !== 'svg'    // copied from Spatie\ImageOptimizer\Optimizers\Svgo
            && $image->extension() !== 'tmp' // windows
            && $image->extension() !== ''    // ubuntu
        ) {
            return false;
        }

        return $image->mime() === 'text/html' || $image->mime() === 'image/svg+xml';
    }

    public function getCommand(): string
    {
        $optionString = implode(' ', $this->options);

        return "{$this->binaryPath}{$this->binaryName} {$optionString}"
            .' --input='.escapeshellarg($this->imagePath)
            .' --output='.escapeshellarg($this->imagePath);
    }
}
