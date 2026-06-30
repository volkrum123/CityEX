<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->render('home', [
            'title'   => 'City Explorer',
            'heading' => 'Welcome to City Explorer!',
            'message' => 'Discover amazing cities around the world.'
        ]);
    }
}