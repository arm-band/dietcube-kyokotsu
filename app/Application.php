<?php
/**
 *
 */

namespace DietcubeKyokotsu;

use Dietcube\Application as DCApplication;
use Pimple\Container;
use DietcubeKyokotsu\Service\SampleService;
use DietcubeKyokotsu\Service\CRYearService;
use DietcubeKyokotsu\Service\SetArrayService;
use DietcubeKyokotsu\Service\NozarashiService;
use DietcubeKyokotsu\Service\ValidationService;
use DietcubeKyokotsu\Service\SessionService;
use DietcubeKyokotsu\Service\TokenService;

class Application extends DCApplication
{
    public function init(Container $container)
    {
        // do something before boot
    }

    public function config(Container $container)
    {
        $configPath = __DIR__ . '/config/config.php';
        if(file_exists($configPath)) {
            $config = require($configPath);
        }
        else {
            throw new \Dietcube\Exception\HttpNotFoundException();
        }

        // setup container or services here
        $container['service.sample'] = function () use ($container)  {
            $sample_service = new SampleService();
            $sample_service->setLogger($container['logger']);
            return $sample_service;
        };
        $container['service.cryear'] = function () use ($container, $config) {
            $cryear_service = new CRYearService($config);
            $cryear_service->setLogger($container['logger']);
            return $cryear_service;
        };
        $container['service.setarray'] = function () use ($container) {
            $setarray_service = new SetArrayService();
            $setarray_service->setLogger($container['logger']);
            return $setarray_service;
        };
        $container['service.nozarashi'] = function () use ($container) {
            $nozarashi_service = new NozarashiService();
            $nozarashi_service->setLogger($container['logger']);
            return $nozarashi_service;
        };
        $container['service.validation'] = function () use ($container) {
            $validation_service = new ValidationService($container);
            $validation_service->setLogger($container['logger']);
            return $validation_service;
        };
        $container['service.session'] = function () use ($container) {
            $session_service = new SessionService();
            $session_service->setLogger($container['logger']);
            return $session_service;
        };
        $container['service.token'] = function () use ($container) {
            $token_service = new TokenService();
            $token_service->setLogger($container['logger']);
            return $token_service;
        };
    }
}
