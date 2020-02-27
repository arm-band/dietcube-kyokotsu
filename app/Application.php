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
use DietcubeKyokotsu\Service\ValidationService;

class Application extends DCApplication
{
    public function init(Container $container)
    {
        // do something before boot
    }

    public function config(Container $container)
    {
        // setup container or services here
        $container['service.sample'] = function () use ($container)  {
            $sample_service = new SampleService();
            $sample_service->setLogger($container['logger']);
            return $sample_service;
        };
        $container['service.cryear'] = function () use ($container) {
            $cryear_service = new CRYearService();
            $cryear_service->setLogger($container['logger']);
            return $cryear_service;
        };
        $container['service.setarray'] = function () use ($container) {
            $setarray_service = new SetArrayService();
            $setarray_service->setLogger($container['logger']);
            return $setarray_service;
        };
        $container['service.validation'] = function () use ($container) {
            $validation_service = new ValidationService($container);
            $validation_service->setLogger($container['logger']);
            return $validation_service;
        };
    }
}
