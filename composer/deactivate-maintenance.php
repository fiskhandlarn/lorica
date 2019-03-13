<?php

if (file_exists(dirname(__DIR__) . '/public/wordpress/.maintenance')) {
    unlink(dirname(__DIR__) . '/public/wordpress/.maintenance');
}
