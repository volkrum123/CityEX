<?php
declare(strict_types=1);

namespace App\Core;

class Application
{
    private Router $router;
    private Request $request;
    private Response $response;

    public function __construct()
    {
        $this->router = new Router();
        $this->request = new Request();
        $this->response = new Response();
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