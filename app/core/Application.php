<?php
declare(strict_types=1);

namespace App\Core;

class Application
{
     private Router $router;
    private Request $request;
    private Response $response;
    private array $config;

    public function __construct()
    {
        $this->router = new Router();
        $this->response = new Response();

        $this->config = require __DIR__ . '/../../config/app.php';

        $this->request = new Request($this->config);
    }

    public function run(): void
    {
        $routes = require __DIR__ . '/../../config/routes.php';
        $routes($this->router);

        $this->router->dispatch(
            $this->request,
            $this->response
        );
    }
}
?>