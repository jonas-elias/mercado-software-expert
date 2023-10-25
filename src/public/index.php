<?php

use ExpertFramework\Container\Container;
use ExpertFramework\Http\Router\Router;

require_once __DIR__.'/../../vendor/autoload.php';

require_once __DIR__.'/../../vendor/expert-framework/helpers/src/helpers.php';

require_once __DIR__.'/../routes/routes.php';

$dispatcher = Container::get('ExpertFramework\Http\Router\Dispatcher');
$request = Container::get('ExpertFramework\Http\Request');

$dispatcher->handle($request, Router::getAllRoutes());
