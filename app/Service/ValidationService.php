<?php

namespace DietcubeKyokotsu\Service;

use Pimple\Container;
use Dietcube\Components\LoggerAwareTrait;
use Valitron\Validator;

/**
 * ValidationService : バリデーション
 *
 */
class ValidationService
{
    use LoggerAwareTrait;

    protected $container;
    protected $v;

    public function __construct(Container $container)
    {
        $this->container = $container;
        \Valitron\Validator::lang('ja');
    }

    /**
     * validationSample       : バリデーションのサンプル
     *
     * @param {array}  $post  : POSTリクエスト された値の配列 ($_POST)
     * @param {string} $token : ワンタイムトークン
     *
     * @return {array}        : エラー文の配列。エラーがない場合は空配列。
     *
     */
    public function validationSample($post, $token)
    {
        $SAMPLE_NAME = 'sample_post';
        $TOKEN_NAME  = 'dc_token';

        //custom valitron / token
        \Valitron\Validator::addRule('token', function ($field, $value, array $params, array $fields) {
            return $value === $params[0];
        }, '{field}が一致しません');

        $v = new \Valitron\Validator($post);
        //required
        $v->rule('required',
            [
                $SAMPLE_NAME,
                $TOKEN_NAME,
            ]
        )->message('{field}は必須です');
        // sample_post
        $v->rule('regex', $SAMPLE_NAME, '/^テストです$/')->message('{field}が不正な値です');

        // token
        $v->rule(
            'token',
            $TOKEN_NAME,
            $token
        )->message('{field}が一致しません');

        //label
        $v->labels([
            $SAMPLE_NAME => 'サンプルPOST',
            $TOKEN_NAME  => 'トークン',
        ]);

        if($v->validate()) {
            return [];
        }
        else {
            $errors = [];
            foreach($v->errors() as $error) {
                foreach($error as $value) {
                    array_push($errors, $value);
                }
            }

            return $errors;
        }
    }
}
