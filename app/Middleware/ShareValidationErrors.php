<?php

namespace App\Middleware;

use App\Session\SessionStore;
use App\Views\View;

class ShareValidationErrors
{
    protected $view;
    protected $session;

    public function __construct(View $view, SessionStore $sessionStore)
    {
        $this->view = $view;
        $this->session = $sessionStore;
    }

    public function __invoke($request, $response, callable $next)
    {
        $this->view->share([
            'errors' => $this->session->get('errors', []),
            'old' => $this->session->get('old', []),
        ]);

        return $next($request, $response);
    }
}