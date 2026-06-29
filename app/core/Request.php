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

    // Remove project base path
    $base = '/php/CityEX/public';

    if (str_starts_with($uri, $base)) {
        $uri = substr($uri, strlen($base));
    }

    // Normalize index.php cases
    $uri = str_replace('/index.php', '', $uri);

    // Ensure root path is "/"
    if ($uri === '' || $uri === false) {
        return '/';
    }

    return $uri;
}
}
?>