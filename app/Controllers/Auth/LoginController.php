<?php

namespace App\Controllers\Auth;

use App\Auth\Hashing\Hasher;
use App\Controllers\Controller;
use App\Views\View;

class LoginController extends Controller
{
    protected $view;
    protected $hasher;

    public function __construct(View $view, Hasher $hasher)
    {
        $this->view = $view;
        $this->hasher = $hasher;
    }

    public function index($request, $response)
    {
        return $this->view->render($response, 'auth/login.twig');
    }

    public function signin($request, $response)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    }
}