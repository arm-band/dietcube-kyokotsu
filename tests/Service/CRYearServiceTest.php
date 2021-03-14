<?php

namespace DietcubeKyokotsu\Service;

class CRYearServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testYearSucceed()
    {
        $configPath = __DIR__ . '/../../app/config/config.php';
        if(file_exists($configPath)) {
            $config = require($configPath);
        }
        else {
            throw new \Dietcube\Exception\HttpNotFoundException();
        }

        $cryear_service = new CRYearService($config);

        $this->assertEquals(
            date('Y'),
            $cryear_service->year()
        );
    }
    public function testYearFailed()
    {
        $configPath = __DIR__ . '/../../app/config/config.php';
        if(file_exists($configPath)) {
            $config = require($configPath);
        }
        else {
            throw new \Dietcube\Exception\HttpNotFoundException();
        }

        $config['appconfig']['year'] = 2020;
        $cryear_service = new CRYearService($config);

        $this->assertEquals(
            $config['appconfig']['year'] . '-' . date('Y'),
            $cryear_service->year()
        );
    }
}
