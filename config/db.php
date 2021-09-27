<?php

return [
    'driver' => 'mysql',
    'server' => 'craft-slim-bridge-dev-db',
    'port' => '3306',
    'database' => getenv('DB_NAME'),
    'user' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'schema' => 'public',
    'tablePrefix' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
];
