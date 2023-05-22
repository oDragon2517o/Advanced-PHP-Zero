<?php

namespace Dragon2517\AdvancedPhpZero\Blog\Repositories\CommentsRepository;

use Dragon2517\AdvancedPhpZero\Blog\Comment;
use Dragon2517\AdvancedPhpZero\Blog\UUID;

interface CommentsRepositoryInterface
{
    public function save(Comment $user): void;
    public function get(UUID $uuid): Comment;
}
