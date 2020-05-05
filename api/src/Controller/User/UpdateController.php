<?php

namespace App\Controller\User;

use App\Orm\Repository\UserRepository;
use App\Helper\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateController
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

        if (empty($json['name'])) {
            return new JsonResponse([
                'error' => [
                    ['message' => 'name must be specified']
                ]
            ]);
        }

        $repository = new UserRepository;
        $repository->update([
            'id' => $json['id'],
            'name' => $json['name'],
        ]);

        return IndexController::index();
    }
}
