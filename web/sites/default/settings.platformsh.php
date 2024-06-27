<?php

use Platformsh\ConfigReader\Config;

$config = new Config();

if ($config->isValidPlatform()) {
    // Configure the database.
    if ($config->hasRelationship('database')) {
        $database = $config->relationships['database'][0];
        $databases['default']['default'] = [
            'driver' => 'mysql',
            'database' => $database['path'],
            'username' => $database['username'],
            'password' => $database['password'],
            'host' => $database['host'],
            'port' => $database['port'],
            'prefix' => '',
        ];
    }

    // Configure Redis.
    if ($config->hasRelationship('redis')) {
        $redis = $config->relationships['redis'][0];
        $settings['redis.connection']['interface'] = 'PhpRedis';
        $settings['redis.connection']['host'] = $redis['host'];
        $settings['redis.connection']['port'] = $redis['port'];
    }
}
