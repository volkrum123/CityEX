<?php

declare(strict_types=1);

namespace App\Core;

class Request
{
    /**
     * Returns the HTTP request method.
     */
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Returns the requested URI.
     */
    public function getUri(): string
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        return $uri ?: '/';
    }
}
?>