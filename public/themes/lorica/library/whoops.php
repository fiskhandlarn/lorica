<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
