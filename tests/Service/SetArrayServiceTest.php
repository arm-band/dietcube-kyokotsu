<?php

namespace DietcubeKyokotsu\Service;

class SetArrayServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testSetFinishArrayTest()
    {
        $configPath = __DIR__ . '/../../app/config/config.php';
        if(file_exists($configPath)) {
            $config = require($configPath);
        }
        else {
            throw new \Dietcube\Exception\HttpNotFoundException();
        }

        $setarray_service = new SetArrayService();
        $cryear_service = new CRYearService($config);

        $this->assertEquals(
            [
                'pagetitle'   => '処理完了',
                'description' => 'Process Finished',
                'cryear'      => $cryear_service->year(),
                'rootpath'    => $_ENV['ROOT_PATH'],
            ],
            $setarray_service->setFinishArray($cryear_service)
        );
    }
    public function testSetErrorArrayTest()
    {
        $configPath = __DIR__ . '/../../app/config/config.php';
        if(file_exists($configPath)) {
            $config = require($configPath);
        }
        else {
            throw new \Dietcube\Exception\HttpNotFoundException();
        }

        $setarray_service = new SetArrayService();
        $cryear_service = new CRYearService($config);

        $code = 400;
        $phrase = 'Bad Request.';
        $errors = [
            'サンプルPOSTが不正な値です'
        ];

        $this->assertEquals(
            [
                'pagetitle'   => $code,
                'description' => $phrase,
                'errors'      => $errors,
                'cryear'      => date('Y'),
                'rootpath'    => $_ENV['ROOT_PATH'],
            ],
            $setarray_service->setErrorArray($code, $phrase, $errors, $cryear_service)
        );
    }
}
