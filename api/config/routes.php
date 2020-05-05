<?php

use Symfony\Component\Routing\Route;
use App\Controller\HttpStatusController;
use App\Controller\BlogController;
use App\Controller\IndexController;

return [
    'index' => new Route('/', ['_controller' => [IndexController::class, 'index']]),
    'blog_show' => new Route('/blog/{slug}', ['_controller' => [BlogController::class, 'index']]),
    'http_not_found' => new Route('/404', ['_controller' => [HttpStatusController::class, 'notFound']]),
    'http_internal_server_error' => new Route('/500', ['_controller' => [HttpStatusController::class, 'internalServerError']]),
];