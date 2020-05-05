<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class IndexController
{
    public static function index()
    {
        return new JsonResponse([
            'message' => 'Welcome to underground'
        ]);
    }
}