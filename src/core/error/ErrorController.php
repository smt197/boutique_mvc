<?php

namespace App\Core\Errors;

use App\Core\Controller;
use App\Core\Errors\HttpCode;

class ErrorController extends Controller {
    public  function loadView($httpCode) {
        $view = '';

        switch ($httpCode) {
            case HttpCode::NOT_FOUND:
                $view = 'errors/404';
                break;
            case HttpCode::FORBIDDEN:
                $view = 'errors/403';
                break;
            default:
                $view = 'errors/general';
                break;
        }

        $this->renderView($view, ['httpCode' => $httpCode]);
    }
}
