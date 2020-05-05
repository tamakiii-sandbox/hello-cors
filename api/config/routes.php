<?php

use App\Controller\CorsController;
use Symfony\Component\Routing\Route;
use App\Controller\HttpStatusController;
use App\Controller\IndexController;
use App\Controller\User;
use Symfony\Component\HttpFoundation\Request;

return [
    // public function __construct(string $path, array $defaults = [], array $requirements = [], array $options = [], ?string $host = '', $schemes = [], $methods = [], ?string $condition = '')
    'index' => new Route('/', ['_controller' => [IndexController::class, 'index']]),
    'users' => new Route('/users', ['_controller' => [User\IndexController::class, 'index']]),
    'user_create' => (new Route('/user/create', ['_controller' => [User\CreateController::class, 'index']]))
        ->setMethods([Request::METHOD_POST]),
    'user_update' => (new Route('/user/update', ['_controller' => [User\UpdateController::class, 'index']]))
        ->setMethods([Request::METHOD_PUT]),
    'user_delete' => (new Route('/user/delete', ['_controller' => [User\DeleteController::class, 'index']]))
        ->setMethods([Request::METHOD_DELETE]),
    'all_patch' => (new Route('/{request}', ['_controller' => [CorsController::class, 'index']]))
        ->setMethods([Request::METHOD_OPTIONS])
        ->setRequirements([
            'request' => '.+',
        ]),
    'http_not_found' => new Route('/404', ['_controller' => [HttpStatusController::class, 'notFound']]),
    'http_internal_server_error' => new Route('/500', ['_controller' => [HttpStatusController::class, 'internalServerError']]),
];