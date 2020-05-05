<?php

namespace App\Controller\User;

use App\Orm\Repository\UserRepository;
use App\Helper\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DeleteController
{
    public static function index(Request $request)
    {
        $json = Json::parse($request->getContent());

        if (empty($json['id'])) {
            return new JsonResponse([
                'error' => [
                    ['message' => 'name must be specified']
                ]
            ]);
        }

        $repository = new UserRepository;
        $repository->delete($json['id']);

        return IndexController::index();
    }
}
