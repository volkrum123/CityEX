<?php

declare(strict_types=1);

namespace App\Core;

class Application
{
    private Router $router;
    private Request $request;
    private Response $response;
    private Database $db;
    private array $config;

    public function __construct()
    {
        $this->router = new Router();
        $this->response = new Response();

        $this->config = require __DIR__ . '/../../config/app.php';

        $this->request = new Request($this->config);

        $dbConfig = require __DIR__ . '/../../config/database.php';
        $this->db = new Database($dbConfig);
    }

    public function run(): void
    {
        // Load routes and register them
        $routes = require __DIR__ . '/../../config/routes.php';
        $routes($this->router);

        // IMPORTANT FIX: only pass request (not response)
        $this->router->dispatch($this->request);
    }
}