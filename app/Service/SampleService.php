<?php

namespace DietcubeKyokotsu\Service;

use Dietcube\Components\LoggerAwareTrait;

/**
 * SampleService : Service のサンプル
 *
 */
class SampleService
{
    use LoggerAwareTrait;

    /**
     * sayHello : サンプル文字列を出力する
     *
     * @return {string}
     *
     */
    public function sayHello()
    {
        return 'Hello, welcome to Dietcube.';
    }
    /**
     * sayKyokotsu : .env の KYOKOTSU の文字列を鸚鵡返しする
     *
     * @return {string}
     *
     */
    public function sayKyokotsu()
    {
        return $_ENV['KYOKOTSU'];
    }
}
