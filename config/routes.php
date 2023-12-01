<?php

declare(strict_types=1);

use sandbox\controller\Controller;
use sandbox\controller\Router;

return function (Router $router) {
    $router->get('/', [Controller::class, 'index']);
    $router->run();
};
