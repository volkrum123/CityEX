<?php

declare(strict_types=1);

namespace App\Core;

class Request
{
    private string $basePath;

    public function __construct(array $config)
    {
        $this->basePath = $config['base_path'] ?? '';
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

public function getUri(): string
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';

    // STEP 1: Define project base path
    $base = '/php/CityEX/public';

    // STEP 2: Remove base path if present
    if (str_starts_with($uri, $base)) {
        $uri = substr($uri, strlen($base));
    }

    // STEP 3: Remove trailing slash
    $uri = rtrim($uri, '/');

    // STEP 4: Ensure root is "/"
    if ($uri === '' || $uri === false) {
        return '/';
    }

    return $uri;
}
}
?>