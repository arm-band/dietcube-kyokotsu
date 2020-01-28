<?php
/**
 *
 */

use Monolog\Logger;

return [
    'debug' => false,

    'logger' => [
        'path' => dirname(dirname(__DIR__)) . '/tmp/app.log',
        'level' => Logger::WARNING,
    ],
    'appconfig' => [
        'appname'     => 'Dietcube Kyokotsu',
        'description' => 'Dietcubeのスケルトンプロジェクトです。',
        'author'      => 'アルム＝バンド',
        'year'        => 2020,
    ],
];
