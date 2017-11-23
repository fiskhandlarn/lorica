<?php

if (function_exists('fly_add_image_size')){
    define('BOOTSTRAP_CONTAINER_MAX', 1140);
    define('BOOTSTRAP_GRID_GUTTER_WIDTH', 30);

    function bootstrapCol($nrCols){
        return ($nrCols * (BOOTSTRAP_CONTAINER_MAX + BOOTSTRAP_GRID_GUTTER_WIDTH))/ 12 - BOOTSTRAP_GRID_GUTTER_WIDTH;
    }

    $minMobileWidth = (360 - 40*2)* 2;

    $heroSize = max($minMobileWidth, ceil(bootstrapCol(12))) * 1.5;
	fly_add_image_size('hero', $heroSize, $heroSize, false);
	fly_add_image_size('single-partner', $heroSize, $heroSize, false);
}
