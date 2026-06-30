<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    /**
     * @var array<string, array<string, array{controller: string, method: string}>>
     */
    private array $routes = [];

    public function get(string $path, string $controller, string $method): void
    {
        $this->routes['GET'][$path] = [
            'controller' => $controller,
            'method'     => $method
        ];
    }

    public function post(string $path, string $controller, string $method): void
    {
        $this->routes['POST'][$path] = [
            'controller' => $controller,
            'method'     => $method
        ];
    }

    public function dispatch(Request $request, Response $response): void
    {
        $method = $request->getMethod();
        $uri = $request->getUri();

        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo "404 - Page Not Found";
            return;
        }

        $route = $this->routes[$method][$uri];

        $controller = new $route['controller']();

        $controller->{$route['method']}();
    }
}