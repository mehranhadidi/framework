<?php

namespace App\Middleware;

use App\Session\SessionStore;

class ClearValidationErrors
{
    protected $session;

    public function __construct(SessionStore $sessionStore)
    {
        $this->session = $sessionStore;
    }

    public function __invoke($request, $response, callable $next)
    {
        // Keep track of pages state (validation errors, uri, ..) and then handle the request
        $next = $next($request, $response);

        // Clear session flash data
        $this->session->clear('errors', 'old');

        return $next;
    }
}