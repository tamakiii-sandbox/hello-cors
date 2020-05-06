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
                'errors' => [
                    ['message' => 'name must be specified']
                ]
            ]);
        }

        $repository = new UserRepository;
        if (!$user = $repository->find($json['id'])) {
            return new JsonResponse([
                'errors' => [
                    ['message' => 'User not found']
                ]
            ]);
        }

        $repository->delete($user['id']);

        return IndexController::index();
    }
}
