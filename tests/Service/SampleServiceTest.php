<?php

namespace DietcubeKyokotsu\Service;

class SampleServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testSayHello()
    {
        $sample_service = new SampleService();

        $this->assertEquals(
            'Hello, welcome to Dietcube.',
            $sample_service->sayHello()
        );
    }
    public function testSayKyokotsu()
    {
        $sample_service = new SampleService();

        $this->assertEquals(
            'HANAHADASHI',
            $sample_service->sayKyokotsu()
        );
    }
}
