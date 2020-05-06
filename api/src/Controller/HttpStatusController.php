<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class HttpStatusController
{
    public static function notFound()
    {
        return new JsonResponse([
            'message' => '404 Not found'
        ], 404);
    }

    public static function internalServerError()
    {
        return new JsonResponse([
            'message' => '500 Internal Server Error'
        ], 500);
    }
}