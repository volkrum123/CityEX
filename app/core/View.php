<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    public function render(string $view, array $data = []): void
    {
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            throw new \RuntimeException("View '{$view}' not found.");
        }

        // Extract variables for view
        extract($data);

        // Start output buffering (capture view HTML)
        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        // Load layout
        require __DIR__ . '/../Views/layouts/main.php';
    }
}