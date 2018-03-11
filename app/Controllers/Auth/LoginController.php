<?php

namespace App\Controllers\Auth;

use App\Auth\Auth;
use App\Controllers\Controller;
use App\Views\View;

class LoginController extends Controller
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
        return $this->view->render($response, 'auth/login.twig');
    }

    public function signin($request, $response)
    {
        $data = $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $attempt = $this->auth->attempt(
            $data['email'],$data['password']
        );

        if(! $attempt) {
            dump('failed');
            die();
        }

        return redirect('/');
    }
}