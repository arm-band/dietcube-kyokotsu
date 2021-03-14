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
        'year'        => 2021,
        'url'         => 'https://localhost:8889/',
        'themecolor'  => '#e5b786',
        'ogp'         => [
            'card'    => 'photo',
            'account' => 'Bredtn_1et',
            'type'    => 'website',
            'image'   => 'webroot/img/eyecatch.jpg',
            'initImg' => 'https://upload.wikimedia.org/wikipedia/commons/4/41/SekienKyokotsu.jpg',
        ],
    ],
];
