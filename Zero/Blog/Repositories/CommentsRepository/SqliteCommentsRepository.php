<?php

namespace Dragon2517\AdvancedPhpZero\Blog\Repositories\SqliteCommentsRepository;

use Dragon2517\AdvancedPhpZero\Blog\Repositories\CommentsRepository\CommentsRepositoryInterface;
use Dragon2517\AdvancedPhpZero\Blog\UUID;
use Dragon2517\AdvancedPhpZero\Blog\Comment;
use Dragon2517\AdvancedPhpZero\Blog\Exceptions\CommentNotFoundException;
use PDO;
use PDOStatement;



class SqliteCommentsRepository implements CommentsRepositoryInterface
{
    public function __construct(
        private PDO $connection
    ) {
    }
    public function save(Comment $commen): void
    {
        // Добавили поле commen в запрос
        $statement = $this->connection->prepare(
            'INSERT INTO users (uuid, post_uuid, author_uuid, text)
                VALUES (:uuid, :post_uuid, :author_uuid, :text)'
        );
        $statement->execute([
            ':uuid' => (string)$commen->uuid(),
            ':post_uuid' => $commen->getUser(),
            ':author_uuid' => $commen->getPost(),
            ':text' => $commen->getText(),
        ]);
    }


    public function get(UUID $uuid): Comment
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM posts WHERE uuid = :uuid'
        );
        $statement->execute([
            ':uuid' => (string)$uuid,
        ]);
        return $this->getPosts($statement, $uuid);
    }

    private function getPosts(PDOStatement $statement, string $author_uuid): Comment
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if (false === $result) {
            throw new CommentNotFoundException(
                "Cannot find user: $author_uuid"
            );
        }
        // Создаём объект пользователя с полем author_uuid
        return new Comment(
            new UUID($result['uuid']),
            $result['post_uuid'],
            $result['author_uuid'],
            $result['text']
        );
    }
}
