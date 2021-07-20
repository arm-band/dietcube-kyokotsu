<?php
/**
 * SampleController
 *
 */

namespace DietcubeKyokotsu\Controller;

use Pimple\Container;
use Dietcube\Controller;
use DietcubeKyokotsu\Helper as Helper;

/**
 * SampleController : サンプルのコントローラ
 *
 */
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
    protected $session_service;
    protected $token_service;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->cryear_service = $this->get('service.cryear');
        $this->setarray_service = $this->get('service.setarray');
        $this->nozarashi_service = $this->get('service.nozarashi');
        $this->validation_service = $this->get('service.validation');
        $this->session_service = $this->get('service.session');
        $this->token_service = $this->get('service.token');
    }

    /**
     * processing : 処理中ページ。 フォームから POSTリクエスト で渡ってきた値をバリデーションし、その結果に応じて正常完了画面(リダイレクト)かエラー画面をレンダリングする
     *
     */
    public function processing()
    {
        if(!$this->nozarashi_service->kusouzu($_SERVER['HTTP_USER_AGENT'])) {
            $this->redirect($_ENV['IE_PATH']);
        }

        // session start
        $token = $this->session_service->startSession($this->token_service);

        $response = $this->getResponse();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validation
            $errors = $this->validation_service->validationSample($_POST, $token);
            if(count($errors)) {
                // session end
                $this->session_service->endSession();

                $response->setStatusCode(self::BAD_REQUEST);
                return $this->render(
                    'error',
                    $this->setarray_service->setErrorArray(
                        self::BAD_REQUEST,
                        $response->getReasonPhrase(),
                        $errors,
                        $this->cryear_service
                    )
                );
            }
            else {
                // redirect
                $this->redirect('finished');
            }
        }
        else {
            // session end
            $this->session_service->endSession();

            $response->setStatusCode(self::METHOD_NOT_ALLOWED);
            return $this->render(
                'error',
                $this->setarray_service->setErrorArray(
                    self::METHOD_NOT_ALLOWED,
                    $response->getReasonPhrase(),
                    [
                        '許可されていないメソッドです。'
                    ],
                    $this->cryear_service
                )
            );
        }
    }
    /**
     * finished : サンプルの完了ページ
     *
     */
    public function finished()
    {
        // session start
        $token = $this->session_service->startSession($this->token_service);
        // session end
        $this->session_service->endSession();

        if(!$this->nozarashi_service->kusouzu($_SERVER['HTTP_USER_AGENT'])) {
            $this->redirect($_ENV['IE_PATH']);
        }

        $response = $this->getResponse();
        $response->setStatusCode(self::OK);
        return $this->render(
            __FUNCTION__,
            $this->setarray_service->setFinishArray(
                $this->cryear_service
            )
        );
    }
}
