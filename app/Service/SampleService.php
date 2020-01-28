<?php

namespace DietcubeKyokotsu\Service;

use Dietcube\Components\LoggerAwareTrait;

class SampleService
{
    use LoggerAwareTrait;

    public function sayHello()
    {
        return 'Hello, welcome to Dietcube.';
    }
    public function sayKyokotsu()
    {
        return getenv('KYOKOTSU');
    }
}
