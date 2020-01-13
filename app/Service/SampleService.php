<?php

namespace DietcubeSkeleton\Service;

use Dietcube\Components\LoggerAwareTrait;

class SampleService
{
    use LoggerAwareTrait;

    public function sayHello()
    {
        return 'Hello, welcome to Dietcube.';
    }
}
