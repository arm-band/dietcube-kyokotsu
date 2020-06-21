<?php
/**
 *
 */

namespace DietcubeKyokotsu\Controller;

use Pimple\Container;
use Dietcube\Controller;

class TopController extends Controller
{
    protected $container;
    protected $cryear_service;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->cryear_service = $this->get('service.cryear');
    }

    public function index()
    {
        $sample_service = $this->get('service.sample');

        return $this->render('index', [
            'sample_hello'    => $sample_service->sayHello(),
            'sample_kyokotsu' => $sample_service->sayKyokotsu(),
            'sample_ichu'     => $_ENV['ICHU'],
            'cryear'          => $this->cryear_service->year(),
            'rootpath'        => $_ENV['ROOT_PATH'],
        ]);
    }
}
