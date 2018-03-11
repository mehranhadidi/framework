<?php

namespace App\Controllers;

use App\Auth\Auth;
use App\Views\View;

class HomeController
{
    protected $view;
    protected $auth;

    public function __construct(View $view, Auth $auth)
    {
        $this->view = $view;
        $this->auth = $auth;
    }

    public function index($request, $response)
    {
        return $this->view->render($response, 'home.twig', [
            'user' => $this->auth->user()
        ]);
    }
}