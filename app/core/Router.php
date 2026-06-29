<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $uri, string $controller, string $method): void
    {
        $this->routes['GET'][$uri] = [
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function dispatch(Request $request, Response $response): void
    {
        $method = $request->getMethod();
        $uri = $request->getUri();

        // Remove the project folder from the URI
        $uri = str_replace('/php/CityEX/public', '', $uri);

        if ($uri === '') {
            $uri = '/';
        }

        if (!isset($this->routes[$method][$uri])) {

            $response->setStatusCode(404);
            $response->send("<h1>404 - Page Not Found</h1>");
            return;
        }

        $route = $this->routes[$method][$uri];

        $controller = new $route['controller']();

        $result = $controller->{$route['method']}();

        $response->send($result);
    }
}
?>