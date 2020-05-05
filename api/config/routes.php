<?php

use Symfony\Component\Routing\Route;
use App\Controller\HttpStatusController;
use App\Controller\IndexController;
use App\Controller\User;

return [
    'index' => new Route('/', ['_controller' => [IndexController::class, 'index']]),
    'users' => new Route('/users', ['_controller' => [User\IndexController::class, 'index']]),
    'http_not_found' => new Route('/404', ['_controller' => [HttpStatusController::class, 'notFound']]),
    'http_internal_server_error' => new Route('/500', ['_controller' => [HttpStatusController::class, 'internalServerError']]),
];