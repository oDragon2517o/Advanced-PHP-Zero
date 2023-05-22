<?php

namespace Dragon2517\AdvancedPhpZero\Blog\Repositories\PostsRepository;

use Dragon2517\AdvancedPhpZero\Blog\Post;
use Dragon2517\AdvancedPhpZero\Blog\UUID;

interface PostsRepositoryInterface
{
    public function save(Post $user): void;
    public function get(UUID $uuid): Post;
}
