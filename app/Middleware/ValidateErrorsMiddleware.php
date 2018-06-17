<?php
/**
 * Created by PhpStorm.
 * User: Kuba
 * Date: 2018-06-16
 * Time: 16:23
 */

namespace App\Middleware;


class ValidateErrorsMiddleware extends Middleware
{
    public function __invoke($request, $response, $next){

        $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
        unset($_SESSION['errors']);

        $response = $next($request, $response);
        return $response;
    }
}