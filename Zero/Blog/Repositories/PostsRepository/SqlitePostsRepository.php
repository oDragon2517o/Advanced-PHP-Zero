<?php


namespace Dragon2517\AdvancedPhpZero\Blog\Repositories\SqlitePostsReposition;

use Dragon2517\AdvancedPhpZero\Blog\Post;
use Dragon2517\AdvancedPhpZero\Blog\Repositories\PostsRepository\PostsRepositoryInterface;
use Dragon2517\AdvancedPhpZero\Blog\UUID;
use Dragon2517\AdvancedPhpZero\Blog\Exceptions\PostsNotFoundException;
use PDO;
use PDOStatement;

class SqlitePostsReposition implements PostsRepositoryInterface
{

    public function __construct(
        private PDO $connection
    ) {
    }

    public function get(UUID $uuid): Post
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM posts WHERE uuid = :uuid'
        );
        $statement->execute([
            ':uuid' => (string)$uuid,
        ]);
        return $this->getPosts($statement, $uuid);
    }

    public function save(Post $post): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO users (uuid, author_uuid, title, text)
                VALUES (:uuid, :author_uuid, :title, :text)'
        );
        $statement->execute([
            ':uuid' => (string)$post->uuid(),
            ':author_uuid' => $post->getUser()->uuid(),
            ':title' => $post->getTitle(),
            ':text' => $post->getText(),
        ]);
    }

    private function getPosts(PDOStatement $statement, string $author_uuid): Post
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if (false === $result) {
            throw new PostsNotFoundException(
                "Cannot find user: $author_uuid"
            );
        }
        // Создаём объект пользователя с полем author_uuid
        return new Post(
            new UUID($result['uuid']),
            $result['author_uuid'],
            $result['title'],
            $result['text']
        );
    }
}
