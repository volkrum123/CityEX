<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    public function render(string $view, array $data = []): void
    {
        extract($data);

        $viewFile = __DIR__ . '/../Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            throw new \RuntimeException("View '{$view}' not found.");
        }

        require $viewFile;
    }
}