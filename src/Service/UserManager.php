<?php

namespace App\Service;

class UserManager
{
    public function findByUsername(string $username): ?array
    {
        $pdo = (new DbConnection())->connect('test', 'root');
        $query = $pdo->prepare('select firstname, lastname, username from user where username = :username');
        $query->bindParam('username', $username);
        $query->execute();

        $user = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        $user['firstname'] = ucfirst($user['firstname']);

        return $user;
    }
}
