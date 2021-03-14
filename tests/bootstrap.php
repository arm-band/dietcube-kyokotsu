<?php

date_default_timezone_set('Asia/Tokyo');
mb_language('ja');
mb_internal_encoding('UTF-8');

require dirname(__DIR__) . '/vendor/autoload.php';

use \Dotenv\Dotenv;

const ENV_PATH = '/../';
const ENV = '.env';

// find environment file
$dot_env = __DIR__ . ENV_PATH . ENV;
if (is_readable($dot_env)) {
    $dotenv = Dotenv::createImmutable(__DIR__ . ENV_PATH);
    $dotenv->load();
}
