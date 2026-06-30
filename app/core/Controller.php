<?php

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function render(string $view, array $data = []): void
    {
        $this->view->render($view, $data);
    }
}