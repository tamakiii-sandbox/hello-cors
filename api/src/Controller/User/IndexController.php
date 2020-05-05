<?php
namespace App\Controller\User;

use Symfony\Component\HttpFoundation\JsonResponse;

class IndexController
{
    public static function index()
    {
        return new JsonResponse([
            'users' => [
                [
                    'id' => 1,
                    'name' => 'John',
                ]
            ],
        ]);
    }
}