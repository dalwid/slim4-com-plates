<?php
session_start();
require '../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Slim\Middleware\MethodOverrideMiddleware;

$app = AppFactory::create();

require '../app/routers/site.php';
require '../app/routers/user.php';

$methodOverrideMiddleware = new MethodOverrideMiddleware();
$app->add($methodOverrideMiddleware);
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($request, $response){
    $response->getBody()->write('Essa porra não existe caralho!');
    return $response;
});

$app->run();