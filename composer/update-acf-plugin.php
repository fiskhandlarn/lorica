<?php

require 'vendor/autoload.php';
use Dotenv\Dotenv;

Dotenv::create('.')->safeLoad();

define('ACF_KEY', env('ACF_KEY'));

define('ACF_PACKAGE_NAME', 'advanced-custom-fields/advanced-custom-fields-pro');
define('ACF_PACKAGE_TYPE', 'wordpress-plugin');

$composer_file_path = sprintf('%s/composer.json', dirname(__DIR__));
if (file_exists($composer_file_path)) {
    $composer_json = @json_decode(@file_get_contents($composer_file_path), true);
    if ($composer_json) {
        $acf_get_info_url = 'https://connect.advancedcustomfields.com/v2/plugins/get-info?p=pro';
        $acf_json = @json_decode(@file_get_contents($acf_get_info_url), true);
        if ($acf_json && !empty($acf_json['version'])) {
            $acf_version = $acf_json['version'];
            if (!isset($composer_json['require'])) {
                $composer_json['require'] = [];
            }
            $composer_json['require'][ACF_PACKAGE_NAME] = $acf_version;

            fwrite(STDOUT, "\033[32mUpdating composer.json with Advanced Custom Fields Plugin \033[33;1mv$acf_version\033[0m\n");

            $acf_repository = [
                'type' => 'package',
                'package' => [
                    'name' => ACF_PACKAGE_NAME,
                    'version' => $acf_version,
                    'type' => ACF_PACKAGE_TYPE,
                    'dist' => [
                        'type' => 'zip',
                        'url' => sprintf('https://connect.advancedcustomfields.com/index.php?p=pro&a=download&k=%s&t=%s', ACF_KEY, $acf_version),
                    ],
                ],
            ];

            $found_acf_repository = false;
            if (isset($composer_json['repositories'])) {
                foreach ($composer_json['repositories'] as $index => $repository) {
                    if (
                        isset($repository['type'], $repository['package']['name']) &&
                        $repository['type'] === 'package' &&
                        $repository['package']['name'] === ACF_PACKAGE_NAME
                    ) {
                        $composer_json['repositories'][$index] = $acf_repository;
                        $found_acf_repository = true;
                        break;
                    }
                }
            }

            if (!$found_acf_repository) {
                if (!isset($composer_json['repositories'])) {
                    $composer_json['repositories'] = [];
                }
                $composer_json['repositories'][] = $acf_repository;
            }

            @file_put_contents($composer_file_path, json_encode($composer_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }
    }
}
