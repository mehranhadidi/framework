<?php

namespace App\Exceptions;

use App\Session\SessionStore;
use Exception;
use ReflectionClass;

class Handler
{
    protected $exception;
    protected $session;

    public function __construct(Exception $exception, SessionStore $session)
    {
        $this->exception = $exception;
        $this->session = $session;
    }

    public function respond()
    {
        $class = (new ReflectionClass($this->exception))->getShortName();

        if(method_exists($this, $method = "handle{$class}")) {
            return $this->{$method}($this->exception);
        }

        $this->unhandledException($this->exception);
    }

    protected function unhandledException(Exception $exception)
    {
        throw new $exception;
    }

    protected function handleValidationException(ValidationException $exception)
    {
        $this->session->set([
            'errors' => $exception->getErrors(),
            'old' => $exception->getOldInput(),
        ]);

        return redirect($exception->getPath());
    }
}