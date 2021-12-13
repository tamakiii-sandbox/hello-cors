<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class CorsController
{
    public function index()
    {
        return new JsonResponse([]);
    }
}