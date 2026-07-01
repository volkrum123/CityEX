<?php

declare(strict_types=1);

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\CityController;

return function (Router $router): void {

    $router->get('/', HomeController::class, 'index');

    $router->get('/about', AboutController::class, 'index');

    $router->get('/cities', CityController::class, 'index');

    $router->get('/cities/{id}', CityController::class, 'show');
};