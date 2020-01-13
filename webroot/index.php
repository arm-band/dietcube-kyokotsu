<?php
/**
 *
 */

require dirname(__DIR__) . '/vendor/autoload.php';

use Dietcube\Dispatcher;

Dispatcher::invoke(
    '\\DietcubeSkeleton\\Application',
    dirname(__DIR__) . '/app',
    Dispatcher::getEnv()
);
