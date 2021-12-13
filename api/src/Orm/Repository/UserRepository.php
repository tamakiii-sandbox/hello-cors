<?php
namespace App\Orm\Repository;

class UserRepository
{
    public function findAll(): ?array
    {
        return array_values(self::readFromFile()['users']);
    }

    public function find($id): ?array
    {
        if (is_array($id)) {
            if (empty($id['id'])) {
                throw new \UnexpectedValueException('Need id');
            }
            $id = $id['id'];
        }

        foreach ($this->findAll() as $user) {
            $user['id'] === (int)$id;
            return $user;
        }

        return null;
    }

    public function add(array $user): bool
    {
        $users = self::findAll();

        array_push($users, array_merge($user, [
            'id' => max(array_column($users, 'id')) + 1,
        ]));

        return self::writeToFile(['users' => $users]);
    }

    public function update(array $user): bool
    {
        $users = self::findAll();

        if (!$key = array_search($user['id'], array_column($users, 'id'))) {
            throw new \UnexpectedValueException('User not found');
        }

        $users[$key] = $user;

        return self::writeToFile(['users' => $users]);
    }

    public function delete(int $id): bool
    {
        $users = array_filter(self::findAll(), function($user) use ($id) {
            // file_put_contents('php://stdout', "${user['id']} !== ${id}" . PHP_EOL);
            return (int)$user['id'] !== $id;
        });

        // file_put_contents('php://stdout', "id: ${id}" . PHP_EOL);
        // file_put_contents('php://stdout', print_r($users, true));

        return self::writeToFile(['users' => array_values($users)]);
    }

    private static function readFromFile(): array
    {
        $file = file_get_contents('/var/tmp/users.json');

        if ($file === false) {
            throw new \RuntimeException('File not found');
        }

        $json = json_decode($file, true);

        if ($json === null) {
            throw new \RuntimeException('Failed to parse json');
        }

        return $json ?? [];
    }

    private static function writeToFile(array $json): bool
    {
        $file = json_encode($json);

        return file_put_contents('/var/tmp/users.json', $file) !== false;
    }
}