<?php

declare(strict_types=1);

namespace App\Core;

class Controller
{
    protected Response $response;

    public function __construct()
    {
        $this->response = new Response();
    }

   protected function render(string $view, array $params = []): void
{
    // Extract variables for view
    extract($params);

    // Capture view output
    ob_start();
    require __DIR__ . '/../Views/' . $view . '.php';
    $content = ob_get_clean();

    // Load layout
    require __DIR__ . '/../Views/layouts/main.php';
}
}