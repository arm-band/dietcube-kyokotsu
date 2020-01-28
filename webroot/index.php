<?php
/**
 *
 */

require dirname(__DIR__) . '/vendor/autoload.php';

use Dietcube\Dispatcher;
use \Dotenv\Dotenv;

// find environment file
$dot_env = __DIR__. '/../.env';
if (is_readable($dot_env)) {
    $dotenv = Dotenv::createImmutable(__DIR__. '/../');
    $dotenv->load();
}

Dispatcher::invoke(
    '\\DietcubeKyokotsu\\Application',
    dirname(__DIR__) . '/app',
    Dispatcher::getEnv()
);
