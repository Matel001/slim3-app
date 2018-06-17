<?php

namespace App\Controllers;


class MainController extends Controller
{
    public function index($request, $response){
        return $this->c->view->render($response, 'main.twig');
    }
}