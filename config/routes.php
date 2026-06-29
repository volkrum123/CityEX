<?php

declare(strict_types=1);

use App\Core\Router;
use App\Controllers\HomeController;

return function (Router $router): void {
echo "ROUTES FILE LOADED<br>";
    $router->get('/', HomeController::class, 'index');

};
?>