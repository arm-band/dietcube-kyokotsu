<?php

namespace DietcubeKyokotsu\Service;

use Pimple\Container;

class ValidationServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testValidationSampleSucceed()
    {
        $container = new Container();
        $validation_service = new ValidationService($container);
        $token = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

        $postData = [
            'sample_post' => 'テストです',
            'dc_token'    => $token,
        ];

        $this->assertEquals(
            [],
            $validation_service->validationSample($postData, $token)
        );
    }
    public function testValidationSampleFailedRequired()
    {
        $container = new Container();
        $validation_service = new ValidationService($container);
        $token = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

        $postData = [];

        $this->assertEquals(
            [
                'サンプルPOSTは必須です',
                'サンプルPOSTが不正な値です',
                'トークンは必須です',
                'トークンが一致しません',
            ],
            $validation_service->validationSample($postData, $token)
        );
    }
    public function testValidationSampleFailedError()
    {
        $container = new Container();
        $validation_service = new ValidationService($container);

        $token  = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
        $token2 = 'yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy';

        $postData = [
            'sample_post' => 'テストですa',
            'dc_token'    => $token2,
        ];

        $this->assertEquals(
            [
                'サンプルPOSTが不正な値です',
                'トークンが一致しません',
            ],
            $validation_service->validationSample($postData, $token)
        );
    }
}
