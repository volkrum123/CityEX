<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    private array $routes;

    public function __construct()
    {
        // IMPORTANT: initialize route buckets
        $this->routes = [
            'GET' => [],
            'POST' => []
        ];
    }

    public function get(string $pattern, string $controller, string $action): void
    {
        $this->routes['GET'][] = [
            'pattern' => $pattern,
            'controller' => $controller,
            'method' => $action
        ];
    }

    public function post(string $pattern, string $controller, string $action): void
    {
        $this->routes['POST'][] = [
            'pattern' => $pattern,
            'controller' => $controller,
            'method' => $action
        ];
    }

    public function dispatch($request): void
    {
        $uri = $request->getUri();
        $method = $request->getMethod();

        foreach ($this->routes[$method] ?? [] as $route) {

            $pattern = $route['pattern'];

            // Convert /cities/{id} → regex
            $regex = preg_replace(
                '#\{[a-zA-Z0-9_]+\}#',
                '([a-zA-Z0-9_-]+)',
                $pattern
            );

            // Allow optional trailing slash + escape slashes safely
            $regex = '#^' . str_replace('/', '\/', rtrim($regex, '/')) . '/?$#';

            if (preg_match($regex, $uri, $matches)) {

                array_shift($matches); // remove full match

                $controller = new $route['controller']();
                $methodName = $route['method'];

                // Pass the Request object as the first argument,
                // followed by any route parameters.
                array_unshift($matches, $request);

                $controller->$methodName(...$matches);

                return;
            }
        }

        http_response_code(404);
        echo "404 - Page Not Found";
    }
}