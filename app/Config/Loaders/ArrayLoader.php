<?php

namespace App\Config\Loaders;

use Exception;

class ArrayLoader implements Loader
{
    public function __construct(array $files)
    {
        $this->files = $files;
    }

    public function parse()
    {
        $parsed = [];

        foreach ($this->files as $namespace => $path) {
            try {
                $parsed[$namespace] = require $path;
            } catch (Exception $exception) {
                //
            }
        }

        return $parsed;
    }
}