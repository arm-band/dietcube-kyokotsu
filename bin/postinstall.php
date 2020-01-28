<?php

try {
    $env_filepath = __DIR__ . '/../';
    if(!file_exists($env_filepath . '.env')) {
        copy($env_filepath . 'sample.env', $env_filepath . '.env');
        echo 'copy successed!';
    }
}
catch (Exception $e) {
    echo 'copy failed!:' . $e->getMessage();
}
