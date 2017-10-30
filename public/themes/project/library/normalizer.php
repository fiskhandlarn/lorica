<?php

declare(strict_types=1);

if (!defined('ABSPATH')) { exit(); }

global $normalizer;

if ( isset( $normalizer ) && $normalizer->compatible_version() ) {
    // also normalize acf fields
    add_filter('acf/update_value', function ($value) use ($normalizer) {
       if (is_string($value)) {
            return $normalizer->tl_normalizer($value);
        }

        return $value;
    });
}
