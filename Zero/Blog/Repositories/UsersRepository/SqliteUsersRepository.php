<?php

namespace Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository;

use Dragon2517\AdvancedPhpZero\Blog\User;
use Dragon2517\AdvancedPhpZero\Blog\UUID;
use Dragon2517\AdvancedPhpZero\Person\Name;
use PDO;


class SqliteUsersRepository implements UsersRepositoryInterface
{
    public function __construct(
        private PDO $connection
    ) {
    }
    public function save(User $user): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO users (first_name, last_name, uuid)
VALUES (:first_name, :last_name, :uuid)'
        );
        $statement->execute([
            ':first_name' => $user->name()->first(),
            ':last_name' => $user->name()->last(),
            // Это работает, потому что класс UUID
            // имеет магический метод __toString(),
            // который вызывается, когда объект
            // приводится к строке с помощью (string)
            ':uuid' => (string)$user->uuid(),
        ]);
    }
    // Также добавим метод для получения
    // пользователя по его UUID
    public function get(UUID $uuid): User
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE uuid = ?'
        );
        $statement->execute([
            ':uuid' => (string)$uuid,
        ]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        // Бросаем исключение, если пользователь не найден
        if (false === $result) {
            throw new UserNotFoundException(
                "Cannot get user: $uuid"
            );
        }
        return new User(
            new UUID($result['uuid']),
            new Name($result['first_name'], $result['last_name'])
        );
    }
}
