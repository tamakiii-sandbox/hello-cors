<?php

use App\Framework\RequestHandler;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;

$autoload = require __DIR__ . '/../vendor/autoload.php';

$routes = new RouteCollection();
foreach (require __DIR__ . '/../config/routing.php' as $key => $route) {
    $routes->add($key, $route);
}

$request = Request::createFromGlobals();
$context = new RequestContext();
$context->fromRequest($request);

$handler = new RequestHandler($routes);
$response = $handler->handle($request, $context);
$response->send();