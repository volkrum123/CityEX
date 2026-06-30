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

    // STEP 1: Remove project base path
    $base = '/php/CityEX/public';

    if (str_starts_with($uri, $base)) {
        $uri = substr($uri, strlen($base));
    }

    // STEP 2: Remove index.php if present
    $uri = str_replace('/index.php', '', $uri);

    // STEP 3: Fix empty values
    if ($uri === '' || $uri === false) {
        return '/';
    }

    // STEP 4: Ensure leading slash
    if ($uri[0] !== '/') {
        $uri = '/' . $uri;
    }

    return $uri;
}
}
?>