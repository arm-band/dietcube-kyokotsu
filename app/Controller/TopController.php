<?php
/**
 * TopController
 *
 */

namespace DietcubeKyokotsu\Controller;

use Pimple\Container;
use Dietcube\Controller;

/**
 * TopController : トップページのコントローラ
 *
 */
class TopController extends Controller
{
    const OK = 200;
    const FORBIDDEN = 403;

    protected $container;
    protected $cryear_service;
    protected $nozarashi_service;
    protected $session_service;
    protected $token_service;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->cryear_service = $this->get('service.cryear');
        $this->nozarashi_service = $this->get('service.nozarashi');
        $this->session_service = $this->get('service.session');
        $this->token_service = $this->get('service.token');
    }

    /**
     * index : トップページ
     *
     */
    public function index()
    {
        if(!$this->nozarashi_service->kusouzu($_SERVER['HTTP_USER_AGENT'])) {
            $this->redirect($_ENV['IE_PATH']);
        }

        // session start
        $token = $this->session_service->startSession($this->token_service);

        $sample_service = $this->get('service.sample');

        $response = $this->getResponse();
        $response->setStatusCode(self::OK);
        return $this->render(
            __FUNCTION__,
            [
                'sample_hello'    => $sample_service->sayHello(),
                'sample_kyokotsu' => $sample_service->sayKyokotsu(),
                'sample_ichu'     => $_ENV['ICHU'],
                'cryear'          => $this->cryear_service->year(),
                'rootpath'        => $_ENV['ROOT_PATH'],
                'token'           => $token,
            ]
        );
    }
    /**
     * errorie : IE >/dev/null 2>&1
     *
     */
    public function errorie()
    {
        $response = $this->getResponse();
        $response->setStatusCode(self::FORBIDDEN);
        return $this->render(
            __FUNCTION__,
            [
                'cryear'          => $this->cryear_service->year(),
                'rootpath'        => $_ENV['ROOT_PATH'],
            ]
        );
    }
}
