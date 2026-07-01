<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

class AboutController extends Controller
{
    public function index(Request $request): void
    {
        $this->render('about', [
            'title' => 'About',
            'heading' => 'About City Explorer',
            'message' => 'This project demonstrates a modern PHP MVC architecture.'
        ]);
    }
}