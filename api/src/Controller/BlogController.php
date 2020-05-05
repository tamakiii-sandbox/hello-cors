<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class BlogController
{
    public static function index()
    {
        return new JsonResponse([
            'hello' => 'world',
        ]);
    }
}