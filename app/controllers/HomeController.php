<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->render('home', [
            'title' => 'City Explorer',
            'heading' => 'Welcome to City Explorer!',
            'message' => 'Discover amazing cities around the world.'
        ]);
    }

    public function cities(): void
    {
        $this->render('cities', [
            'title' => 'Cities',
            'heading' => 'Explore Cities',
            'message' => 'City list will appear here soon.'
        ]);
    }

    public function about(): void
    {
        $this->render('about', [
            'title' => 'About',
            'heading' => 'About City Explorer',
            'message' => 'This is a learning project built in PHP MVC.'
        ]);
    }
}