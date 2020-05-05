<?php

use Symfony\Component\Routing\Route;
use App\Controller\HttpStatusController;
use App\Controller\BlogController;

return [
    'blog_show' => new Route('/blog/{slug}', ['_controller' => [BlogController::class, 'index']]),
    'not_found' => new Route('/404', ['_controller' => [HttpStatusController::class, 'notFound']]),
    'not_found' => new Route('/500', ['_controller' => [HttpStatusController::class, 'internalServerError']]),
];