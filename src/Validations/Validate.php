<?php

namespace Phplite\Validation;

use Phplite\Http\Request;
use Phplite\Session\Session;
use Phplite\Url\Url;
use Rakit\Validation\Validator;

class Validate
{
    /**
     * Validation constructor
     */
    private function __construct()
    {
    }

    /**
     * Validate request
     * @param array $rules
     * @param bool $json
     * @return mixed
     */
    public static function validate(array $rules, $json)
    {
        $validator  = new Validator;
        $validation = $validator->validate($_POST + $_FILES, $rules);
        $errors     = $validation->errors();
        if ($validation->fails()) {
            if ($json) {
                return ['errors' => $errors->firstOfAll()];

            } else {
                Session::set('errors', $errors);
                Session::set('old', Request::all());
                return Url::redirect(URl::previous());
            }
            // handling errors

        }
    }
}