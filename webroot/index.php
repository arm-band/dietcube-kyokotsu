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

if(!(Integer)getEnv('PROD_FLG')) {
    ini_set('xdebug.var_display_max_children', -1);
    ini_set('xdebug.var_display_max_data', -1);
    ini_set('xdebug.var_display_max_depth', -1);
}

Dispatcher::invoke(
    '\\DietcubeKyokotsu\\Application',
    dirname(__DIR__) . '/app',
    Dispatcher::getEnv()
);
