<?php

namespace App\Core\Validator;

interface ValidatorInterface {
    public function validate($data, $rules);
    public function addError($field, $message);
    public function getErrors();
}
