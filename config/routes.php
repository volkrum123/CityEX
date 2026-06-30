<?php

declare(strict_types=1);

use App\Core\Router;
use App\Controllers\HomeController;

return function (Router $router): void {
    $router->get('/', HomeController::class, 'index');
    $router->get('/cities', HomeController::class, 'cities');
    $router->get('/about', HomeController::class, 'about');
};
?>