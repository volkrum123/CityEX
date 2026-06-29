<?php

declare(strict_types=1);

namespace App\Controllers;

class HomeController
{
    public function index(): string
    {
        return "<h1>Welcome to City Explorer!</h1>";
    }
}
?>