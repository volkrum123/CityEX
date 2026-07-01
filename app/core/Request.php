<?php

declare(strict_types=1);

namespace App\Core;

class Request
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getUri(): string
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $basePath = rtrim($this->config['base_path'], '/');

        if ($basePath !== '' && str_starts_with($uri, $basePath)) {
            $uri = substr($uri, strlen($basePath));
        }

        $uri = '/' . trim($uri, '/');

        return $uri === '//' ? '/' : $uri;
    }

    /**
     * Returns a query string value.
     * Example: /cities?search=Cape
     */
    public function getQuery(string $key, mixed $default = null): mixed
    {
        return $_GET[$key] ?? $default;
    }

    /**
     * Returns all query string parameters.
     */
    public function getQueryParams(): array
    {
        return $_GET;
    }
}