<?php

declare(strict_types=1);

use sandbox\controller\Router;

require_once __DIR__ . '/../config/constant.php';
require_once ROOT_PATH . '/vendor/autoload.php';

$container = require_once CONFIG_PATH . '/container.php';
$routes = require_once CONFIG_PATH . '/routes.php';

$router = new Router($container);
$routes($router);
