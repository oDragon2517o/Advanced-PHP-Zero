<?php

namespace Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository;

use Dragon2517\AdvancedPhpZero\Blog\User;
use Dragon2517\AdvancedPhpZero\Blog\UUID;
use Dragon2517\AdvancedPhpZero\Person\Name;
use Dragon2517\AdvancedPhpZero\Blog\Exceptions\UserNotFoundException;
use PDO;
use PDOStatement;


class SqliteUsersRepository implements UsersRepositoryInterface
{
    public function __construct(
        private PDO $connection
    ) {
    }
    public function save(User $user): void
    {
        // Добавили поле username в запрос
        $statement = $this->connection->prepare(
            'INSERT INTO users (uuid, username, first_name, last_name)
        VALUES (:uuid, :username, :first_name, :last_name)'
        );
        $statement->execute([
            ':uuid' => (string)$user->uuid(),
            ':username' => $user->username(),
            ':first_name' => $user->name()->first(),
            ':last_name' => $user->name()->last(),
        ]);
    }
    public function get(UUID $uuid): User
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE uuid = :uuid'
        );
        $statement->execute([
            ':uuid' => (string)$uuid,
        ]);
        return $this->getUser($statement, $uuid);
    }
    // Добавили метод получения пользователя по username
    public function getByUsername(string $username): User
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE username = :username'
        );
        $statement->execute([
            ':username' => $username,
        ]);
        return $this->getUser($statement, $username);
    }
    // Вынесли общую логику в отдельный приватный метод
    private function getUser(PDOStatement $statement, string $username): User
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if (false === $result) {
            throw new UserNotFoundException(
                "Cannot find user: $username"
            );
        }
        // Создаём объект пользователя с полем username
        return new User(
            new UUID($result['uuid']),
            $result['username'],
            new Name($result['first_name'], $result['last_name'])
        );
    }
}
