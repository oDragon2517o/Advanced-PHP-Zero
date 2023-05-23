<?php

namespace Dragon2517\AdvancedPhpZero\Blog\Repositories\SqliteCommentsRepository;

use Dragon2517\AdvancedPhpZero\Blog\Repositories\CommentsRepository\CommentsRepositoryInterface;
use Dragon2517\AdvancedPhpZero\Blog\UUID;
use Dragon2517\AdvancedPhpZero\Blog\Comment;
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
            ':author_uuiid' => $commen->author_uuiid(),
            ':title' => $commen->title(),
            ':text' => $commen->text(),
        ]);
    }
    public function get(UUID $uuid): Comment
    {
    }
}
