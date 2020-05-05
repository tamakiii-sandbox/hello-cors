<?php
namespace App\Controller\User;

use App\Helper\ArrayIterator;
use App\Orm\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class IndexController
{
    public static function index()
    {
        $repository = new UserRepository;

        return new JsonResponse([
            'users' => array_filter(
                ArrayIterator::map(
                    $repository->findAll(),
                    function(array $user) {
                        return [
                            'id' => $user['id'] ?? null,
                            'name' => $user['name'] ?? null,
                        ];
                    }
                )
            )
        ]);
    }
}