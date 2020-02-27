<?php
/**
 *
 */

namespace DietcubeKyokotsu\Controller;

use Pimple\Container;
use Dietcube\Controller;
use Valitron\Validator;
use DietcubeKyokotsu\Helper as Helper;

class SampleController extends Controller
{
    const OK = 200;
    const BAD_REQUEST = 400;
    const FORBIDDEN = 403;
    const METHOD_NOT_ALLOWED = 405;

    protected $container;
    protected $sample_service;
    protected $cryear_service;
    protected $setarray_service;
    protected $validation_service;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->sample_service = $this->get('service.sample');
        $this->cryear_service = $this->get('service.cryear');
        $this->setarray_service = $this->get('service.setarray');
        $this->validation_service = $this->get('service.validation');
    }

    public function sample()
    {
        $response = $this->getResponse();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validation
            $errors = $this->validation_service->validationSample($_POST);
            $response = $this->getResponse();
            if(count($errors)) {
                $response->setStatusCode(self::BAD_REQUEST);
                return $this->render('error', $this->setarray_service->setErrorArray(self::BAD_REQUEST, $response->getReasonPhrase(), $errors, $this->cryear_service));
            }
            else {
                return $this->render('finished', $this->setarray_service->setFinishArray($this->cryear_service));
            }
        }
        else {
            $response->setStatusCode(self::METHOD_NOT_ALLOWED);
            return $this->render('error', $this->setarray_service->setErrorArray(self::METHOD_NOT_ALLOWED, $response->getReasonPhrase(), ['許可されていないメソッドです。'], $this->cryear_service));
        }
    }
}
