<?php

namespace Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository;

use Dragon2517\AdvancedPhpZero\Blog\User;
use Dragon2517\AdvancedPhpZero\Blog\UUID;

interface UsersRepositoryInterface
{
    public function save(User $user): void;
    public function get(UUID $uuid): User;
}
