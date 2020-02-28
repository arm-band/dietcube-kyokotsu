<?php

namespace DietcubeKyokotsu\Service;

use Pimple\Container;
use Dietcube\Components\LoggerAwareTrait;
use Valitron\Validator;

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

    public function validationSample($post)
    {
        $SAMPLE_NAME = 'sample_post';
        $v = new \Valitron\Validator($post);
        //required
        $v->rule('required',
            [
                $SAMPLE_NAME,
            ]
        )->message('{field}は必須です');
        $v->rule('regex', $SAMPLE_NAME, '/^テストです$/')->message('{field}が不正な値です');

        //label
        $v->labels([
            $SAMPLE_NAME => 'サンプルPOST',
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
