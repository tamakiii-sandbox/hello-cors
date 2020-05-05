<?php
namespace App\Orm\Repository;

class UserRepository
{
    public function findAll()
    {
        return self::readFromFile()['users'];
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
        $users = self::findAll();

        if (!$key = array_search($id, array_column($users, 'id'))) {
            throw new \UnexpectedValueException('User not found');
        }

        unset($users[$key]);

        return self::writeToFile(['users' => $users]);
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