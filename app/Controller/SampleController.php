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
    const METHOD_NOT_ALLOWED = 405;

    protected $container;
    protected $cryear_service;
    protected $setarray_service;
    protected $nozarashi_service;
    protected $validation_service;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->cryear_service = $this->get('service.cryear');
        $this->setarray_service = $this->get('service.setarray');
        $this->nozarashi_service = $this->get('service.nozarashi');
        $this->validation_service = $this->get('service.validation');
    }

    public function sample()
    {
        if(!$this->nozarashi_service->kusouzu($_SERVER['HTTP_USER_AGENT'])) {
            $this->redirect($_ENV['IE_PATH']);
        }
        $response = $this->getResponse();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validation
            $errors = $this->validation_service->validationSample($_POST);
            if(count($errors)) {
                $response->setStatusCode(self::BAD_REQUEST);
                return $this->render('error', $this->setarray_service->setErrorArray(self::BAD_REQUEST, $response->getReasonPhrase(), $errors, $this->cryear_service));
            }
            else {
                $response->setStatusCode(self::OK);
                return $this->render('finished', $this->setarray_service->setFinishArray($this->cryear_service));
            }
        }
        else {
            $response->setStatusCode(self::METHOD_NOT_ALLOWED);
            return $this->render('error', $this->setarray_service->setErrorArray(self::METHOD_NOT_ALLOWED, $response->getReasonPhrase(), ['許可されていないメソッドです。'], $this->cryear_service));
        }
    }
}
